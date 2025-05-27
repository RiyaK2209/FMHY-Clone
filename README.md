# FMHY Clone

A modern, responsive web application that serves as a comprehensive resource directory, inspired by FMHY (FreeMediaHeckYeah). This project provides a clean and intuitive interface for browsing and searching through various categories of resources.

## Features

- 🎯 Modern and responsive design
- 🔍 Real-time search functionality
- 📱 Mobile-friendly interface
- 🎨 Clean and intuitive UI
- 📂 Categorized resources
- ⚡ Fast and lightweight

## Getting Started

### Prerequisites

- A modern web browser
- A local web server (e.g., XAMPP, Live Server, or any HTTP server)

### Installation

1. Clone the repository:
```bash
git clone https://github.com/yourusername/fmhy-clone.git
```

2. Navigate to the project directory:
```bash
cd fmhy-clone
```

3. If you're using Visual Studio Code, you can use the Live Server extension to run the project. Otherwise, set up your preferred local web server to serve the files.

4. Open `index.html` in your web browser through the local server.

## Project Structure

```
fmhy-clone/
├── index.html          # Main HTML file
├── styles/
│   └── main.css       # Main stylesheet
├── js/
│   └── main.js        # JavaScript functionality
└── README.md          # Project documentation
```

## Customization

### Adding New Categories

To add new categories, modify the category grid in `index.html` and add corresponding styles in `main.css`. You can use Font Awesome icons for the category icons.

### Adding Resources

Resources are currently stored in the `resources` array in `main.js`. In a production environment, these would typically come from a backend API. To add new resources, add objects to the array following this structure:

```javascript
{
    title: 'Resource Title',
    description: 'Resource Description',
    category: 'Category Name',
    icon: 'fa-icon-name'
}
```

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Acknowledgments

- Inspired by [FMHY](https://fmhy.net)
- Icons by [Font Awesome](https://fontawesome.com)
- Built with modern HTML5, CSS3, and JavaScript
