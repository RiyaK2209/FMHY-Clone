const express = require('express');
const path = require('path');
const fs = require('fs').promises;
const matter = require('gray-matter');

const app = express();
const port = process.env.PORT || 5500;

// Middleware
app.use(express.json());
app.use(express.static(path.join(__dirname)));

// Search API endpoint
app.post('/api/search', async (req, res) => {
    try {
        const { query } = req.body;
        if (!query) {
            return res.status(400).json({ error: 'Query is required' });
        }

        const docsPath = path.join(__dirname, 'edit-main', 'docs');
        const results = await searchMarkdownFiles(docsPath, query.toLowerCase());
        res.json(results);
    } catch (error) {
        console.error('Search error:', error);
        res.status(500).json({ error: 'Internal server error' });
    }
});

async function searchMarkdownFiles(docsPath, searchQuery) {
    const results = [];
    
    try {
        const files = await fs.readdir(docsPath);
        const markdownFiles = files.filter(file => file.endsWith('.md'));

        for (const file of markdownFiles) {
            const filePath = path.join(docsPath, file);
            const content = await fs.readFile(filePath, 'utf-8');
            
            // Parse front matter if exists
            const { data, content: markdownContent } = matter(content);
            
            // Search in content
            if (markdownContent.toLowerCase().includes(searchQuery)) {
                // Find the context around the match
                const lines = markdownContent.split('\n');
                let matchingLine = '';
                let title = data.title || file.replace('.md', '');
                
                // Find first matching line for excerpt
                for (const line of lines) {
                    if (line.toLowerCase().includes(searchQuery)) {
                        matchingLine = line;
                        break;
                    }
                }

                // Calculate relevance score (simple implementation)
                const matches = markdownContent.toLowerCase().split(searchQuery).length - 1;
                const relevance = Math.min(100, (matches * 10));

                // Determine category based on filename
                let category = 'Resource';
                if (file.includes('guide')) {
                    category = 'Guide';
                } else if (file.includes('tools')) {
                    category = 'Tools';
                }

                // Clean up the title
                title = title.replace(/-/g, ' ')
                    .split(' ')
                    .map(word => word.charAt(0).toUpperCase() + word.slice(1))
                    .join(' ');

                results.push({
                    title,
                    file: file.replace('.md', ''),
                    excerpt: matchingLine.trim() || 'No preview available',
                    category,
                    relevance
                });
            }
        }

        // Sort results by relevance
        return results.sort((a, b) => b.relevance - a.relevance);
    } catch (error) {
        console.error('Error searching markdown files:', error);
        throw error;
    }
}

// Start server
app.listen(port, () => {
    console.log(`Server running at http://localhost:${port}`);
}); 