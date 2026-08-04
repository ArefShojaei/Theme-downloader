<div align="center">
<img width="100%" alt="cover" src="https://github.com/user-attachments/assets/8cabbce1-d3c4-4311-9b21-718e54512c34" />

<h1 align="center">📥 Theme Downloader - SSR Rendering Model</h1>

<p align="center">
    Download your favorite HTML themes from anywhere with a simple CLI command.
    Automatically fetch HTML pages, assets, styles, scripts, images, and organize them into a ready-to-use local project.
</p>

</div>

---

## ✨ Features

* 🌐 Download any public HTML theme from a URL
* 🎨 Automatically detect and download CSS, JavaScript, fonts, and images
* 📁 Organize assets into a clean project structure
* ⚡ Simple CLI interface
* 📦 Support bulk downloading using configuration files
* 🪶 Lightweight and built with pure PHP
* 🚀 Ready for local development and customization

---

## 📥 Installation

### Install with Composer

```bash
composer create-project arefshojaei/theme-downloader:dev-main my-project
```

Move into the project directory:

```bash
cd my-project
```

---

## Clone from GitHub

```bash
git clone https://github.com/ArefShojaei/Theme-downloader.git

cd Theme-downloader
```

Install dependencies:

```bash
composer install
```

---

## 🚀 Quick Start

### Download a single theme

Use a theme URL:

```bash
php cli theme https://example.com
```

---

### Download multiple themes

Define your themes inside:

```txt
theme.config.json
```

Then run:

```bash
php cli theme --config
```

---

## 📂 Downloaded Project Structure

After downloading a theme, your output will look like this:

```txt
theme/
│
├── assets/
│   └── css/
│   ├── js/
│   ├── fonts/
│   ├── images/
│
└── index.html
```

The theme is now available for local development and customization.

---

## 🖥 Preview the Downloaded Theme

For the best experience, run the theme using a local web server because some assets may require HTTP access.

### Method 1: Live Server (VS Code Extension)

Install the **Live Server** extension and open the theme directory.

---

### Method 2: PHP Built-in Web Server

Move to the downloaded theme:

```bash
cd dist/theme-name
```

Start the server:

```bash
php -S localhost:5200
```

Open your browser:

```txt
http://localhost:5200
```

---

## 🔧 Example Workflow

1. Download a theme:

```bash
php cli theme https://my-theme.com
```

2. Enter the generated directory:

```bash
cd dist/my-theme
```

3. Run a local server:

```bash
php -S localhost:5200
```

4. Customize the theme files and start development.

---

## 🏗 How It Works

```txt
Website URL
     |
     |
 HTML Parser
     |
     |
 Asset Extractor
     |
     |
 Downloader Engine
     |
     |
 File Organizer
     |
     |
 Local Theme Project
```

---

## 💡 Use Cases

This project is useful for:

* Saving HTML themes for offline usage
* Creating local copies of website themes
* Learning frontend architecture
* Customizing existing themes
* Building prototypes faster

---

## 🔥 Why Theme Downloader?

Instead of manually downloading every image, stylesheet, font, and JavaScript file, Theme Downloader automates the entire process with a single command.

It saves time and provides a clean starting point for your frontend projects.

---

## 👨‍💻 Author

**Aref Shojaei**

* GitHub: https://github.com/ArefShojaei

---

## ⭐ Show Your Support

If this project saves your time and helps your workflow, consider giving it a **Star ⭐** on GitHub.

Your support motivates future improvements.
