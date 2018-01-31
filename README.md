# EZSolder
[![version](https://img.shields.io/badge/version-1.2.3-lightgrey.svg?style=flat-square)](https://github.com/Flawedspirit/EZSolder)
[![license](https://img.shields.io/badge/License-GPL-blue.svg?style=flat-square)](https://github.com/Flawedspirit/EZSolder)
[![web](https://img.shields.io/badge/web-flawedspirit.com-blue.svg?style=flat-square)](https://flawedspirit.com)
[![github](https://img.shields.io/badge/github-Flawedspirit%2FEZSolder-blue.svg?style=flat-square)](https://github.com/Flawedspirit/EZSolder)
## What is EZSolder?
EZSolder is a faster way of packaging and uploading an assortment of files that are of use in a Minecraft Technic modpack.

## Requirements
- PHP 5.2+
- A MySQL database
- [Technic Solder](https://solder.io) and associated database tables
- Knowledge of how to operate Apache/Nginx/Lighttpd/IIS

## Installing
Simply navigate to the directory you wish to install EZSolder in and run

`git clone https://github.com/Flawedspirit/EZSolder.git`

## Setup
After installation, you'll want to edit **config.php** and input the right information.
- REPO: The *absolute path* of your Solder mod repository from your server (or webhost's virtual) root e.g. `/var/www/htdocs/solder/mods`
- COOKIE_DOMAIN: The domain this script runs from; part of the safe operation of cookies
- DB_HOST: The location of your Solder database. Usually `localhost`.
- DB_USER: The user assigned to your Solder database. If I catch anyone using root...
- DB_PASS: Said user's password.
- DB_NAME: The name of your Solder database.
- PREFIX: If your database tables use a prefix, enter it here. This can usually be left blank. Usually only used if your web host only allows you to use one database. (If this is the case, find a different host!)

## Usage
If everything went right, you'll be at the uploader page. The fields are for the most part self-explanatory, but some things to mention are:
- Mod name and mod author only need to be specified if a **new** mod is being added to the repo.
- Modslug, version, a file to upload, and the destination always need to be specified.
- Standard destinations (mods, configs, etc.) can be selected, or a custom location can be entered if your file needs to go elsewhere, e.g. liteconfigs, resourcepacks, scripts, etc.
- Some mods are split into multiple jars (Project Red comes to mind). To avoid having to upload multiple files, you can create a .zip file on your computer and upload that instead of multiple files.

## Support
Something wrong or missing? Please open an issue [here](https://github.com/Flawedspirit/EZSolder/issues) and I will endeavor to fix it or add it. Please note that this was mostly a personal project and I consider it somewhat feature complete at this point in time. However, if I *really* like an idea, I will totally consider it!

Alternatively, you can just make a pull request, because that is how git works.

## Credits
Thanks to CaitlynMainer for her help with (and outright addition) of cool stuff like a lot of the database code, and the automatic modslug search.