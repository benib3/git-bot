# Git Bot

A Symfony-based bot for automating Git repository updates with random content. This tool provides a simple and configurable way to keep repositories active with scheduled commits.

## Overview

Git Bot is a PHP application that:

1. Opens a configured Git repository
2. Updates a target file with randomly generated content
3. Commits and pushes changes automatically
4. Handles common Git operations with error handling

This can be useful for:

- Keeping repositories active for demonstration purposes
- Testing CI/CD pipelines
- Creating commit history patterns
- Simulating development activity

## Installation

### Prerequisites

- PHP 8.2 or higher
- Composer
- Git installed on the server

### Setup

1. Clone the repository:

**git** **clone** **https://github.com/benib3/git-bot.git**

**cd** **git-bot**

2. Install dependencies:

**composer** **install**

3. Create a repository directory:

**mkdir** **-p** **repo**

**cd** **repo**

**git** **init**

4. Configure the target repository:

**git** **remote** **add** **origin** **https://github.com/yourusername/target-repository.**git

5. Create the initial file:

**echo** **"**Initial content**"** **>** **love.txt**

**git** **add** **love.txt**

**git** **commit** **-m** **"**Initial commit**"**

**git** **push** **-u** **origin** **main** **# or 'master' depending on your branch name**

## Configuration

The bot is configured with these constants in the `Bot` class:

- `REPO`: Path to the Git repository relative to the project directory (default: [repo](vscode-file://vscode-app/snap/code/187/usr/share/code/resources/app/out/vs/code/electron-sandbox/workbench/workbench.html))
- `FILE`: Path to the file that will be updated (default: `/love.txt`)
- `DEFAULT_REMOTE`: Name of the remote repository to push to (default: `origin`)

## Usage

### Manual Execution

Run the bot with the Symfony console:

**php** **bin/console** **app:bot:play**

### Scheduled Execution

To run the bot on a schedule, add a cron job:

**# Run every day at 10:00 AM**

**0** **10** **\*** **\*** **\*** **cd** **/path/to/git-bot** **&&** **php** **bin/console** **app:bot:play**

## Customization

### Content Generation

The bot uses a custom `Faker` service to generate random content. You can modify `App\Faker\Faker` to change the content generation logic.

### Git Operations

The bot handles these Git operations:

- Opening repositories
- Adding files
- Committing changes
- Pushing to remotes
- Error handling for common Git issues

## Error Handling

The bot includes robust error handling for:

- Non-existent repositories
- Missing remotes
- Push failures
- Upstream branch issues

## Project Structure

**git-bot/**

**├── config/ # Symfony configuration**

**├── repo/ # Target Git repository**

**├── src/**

**│ ├── Bot/**

**│ │ └── Bot.php # Main bot implementation**

**│ ├── Command/ # Symfony commands**

**│ └── Faker/ # Content generation**

**└── composer.json # Dependencies**

## Dependencies

- Symfony Framework 7.2.\*
- czproject/git-php 4.3.\*
- fakerphp/faker

## License

This project is licensed under the proprietary license.

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.
