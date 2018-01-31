# EZSolder
[![version](https://img.shields.io/badge/version-2.1.3--beta-lightgrey.svg?style=flat-square)](https://github.com/Flawedspirit/EZSolder)
[![license](https://img.shields.io/badge/License-GPL-blue.svg?style=flat-square)](https://github.com/Flawedspirit/EZSolder)
[![web](https://img.shields.io/badge/web-flawedspirit.com-blue.svg?style=flat-square)](https://flawedspirit.com)
[![github](https://img.shields.io/badge/github-Flawedspirit%2FEZSolder-blue.svg?style=flat-square)](https://github.com/Flawedspirit/EZSolder)

## What is EZSolder?
EZSolder is a faster way of packaging and uploading an assortment of files that are of use in a Minecraft Technic modpack. Solder is a wonderful tool but as of this point, it does not support uploading a file to its proper location and format from its interface. The process is manual and laborious. Until then, or maybe even beyond, EZSolder is here to fill that gap.

## Requirements
- PHP 5.2+
- PHP zip extension enabled
- A MySQL database
- [Technic Solder](https://solder.io) and associated database tables
- Knowledge of how to operate Apache/Nginx/Lighttpd/IIS
- A copy of Minecraft (otherwise, why make modpacks?)

## Installing/Updating
Simply navigate to the directory you wish to install EZSolder in and run

`git clone https://github.com/Flawedspirit/EZSolder.git`

To update to the next version, navigate to your EZSolder install directory and run

`git fetch` and `git pull origin`

## Setup
After installation, you'll want to edit **config.dist.php**, input the right information, and rename it to **config.php**.
- url: The base url where you'll access your installation e.g. `https://example.com/ezsolder`. If this isn't set EZSolder will attempt to figure it out on its own.
- repository: The *absolute path* of your Solder mod repository from your server's (or webhost's virtual) root e.g. `/var/www/htdocs/solder/mods`
- hostname: The location of your Solder database. Usually `localhost`.
- database: The name of your Solder database.
- username: The user assigned to your Solder database.
- password: Said user's password.
- prefix: If your database tables use a prefix, enter it here. This can usually be left blank. Usually only used if your web host only allows you to use one database. (If this is the case, find a different host!)

## Usage
If everything went right, you'll be at the uploader page. The fields are for the most part self-explanatory, but some things to mention are:
- Mod name and mod author only need to be specified if a **new** mod is being added to the repo.
- The modslug, mod version, a file to upload, and the destination always need to be specified.
- Standard destinations (mods, configs, etc.) can be selected, or a custom location can be entered if your file needs to go elsewhere, e.g. liteconfigs, resourcepacks, scripts, etc. The dropdown defaults to "mods".
- EZSolder supports uploading a pre-packaged zip file and updating the database accordingly, in the event that several files need to be uploaded and packaged into one zip file. Note, however, that the files will need to be packaged properly on your end so that they go into the proper places that Forge expects them to be.

## Support
Something wrong or missing? Please open an issue [here](https://github.com/Flawedspirit/EZSolder/issues) and I will endeavor to fix it or add it. Please note that this was mostly a personal project and I consider it somewhat feature complete at this point in time. However, if I *really* like an idea, I will totally consider it!

Alternatively, you can just make a pull request, because that is how git works.

## Credits
Thanks to [CaitlynMainer](https://github.com/CaitlynMainer) for her help with (and outright addition) of cool stuff like a lot of the database code, and the automatic modslug autofill.