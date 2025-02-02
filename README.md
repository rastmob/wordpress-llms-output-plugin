# LLMs Training WordPress Plugin

A WordPress plugin to export posts, pages, and custom post types as JSON for training Language Models (LLMs).

## Description

The **LLMs Training** plugin allows you to export your WordPress content (posts, pages, and custom post types) as a JSON file. This JSON file can be used to train Language Models (LLMs) like GPT, BERT, or other NLP models.

## Features

- Export posts, pages, and custom post types as JSON.
- Include metadata such as title, content, author, categories, tags, and more.
- Simple one-click export from the WordPress admin dashboard.
- JSON file saved in the WordPress uploads directory with a downloadable link.

## Installation

1. Download the plugin ZIP file or clone this repository.
2. Upload the `llms-training` folder to the `/wp-content/plugins/` directory of your WordPress installation.
3. Activate the plugin through the **Plugins** menu in WordPress.
4. Go to **LLMs Training** in the admin menu and click **Export Data** to generate the JSON file.

## Usage

1. Navigate to **LLMs Training** in the WordPress admin menu.
2. Click the **Export Data** button.
3. Once the export is complete, a download link for the JSON file will appear.

## Example JSON Output

```json
[
    {
        "id": 1,
        "title": "Hello World",
        "content": "Welcome to WordPress. This is your first post.",
        "excerpt": "",
        "slug": "hello-world",
        "date": "2023-01-01 00:00:00",
        "modified": "2023-01-01 00:00:00",
        "author": "admin",
        "categories": ["Uncategorized"],
        "tags": []
    }
]