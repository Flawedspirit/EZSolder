# EZSolder
[![version](https://img.shields.io/badge/Version-2.0--beta-lightgrey.svg?style=flat-square)](https://github.com/Flawedspirit/EZSolder)
[![license](https://img.shields.io/badge/License-GPL-blue.svg?style=flat-square)](https://www.gnu.org/licenses/gpl-3.0.en.html)
[![web](https://img.shields.io/badge/web-flawedspirit.com-blue.svg?style=flat-square)](https://flawedspirit.com)
[![github](https://img.shields.io/badge/github-Flawedspirit%2FEZSolder-blue.svg?style=flat-square)](https://github.com/Flawedspirit/EZSolder)
## What is EZSolder?
EZSolder is a faster way of packaging and uploading an assortment of files that are of use in a Minecraft Technic modpack.

## Requirements
- PHP 5.2+
- The PHP native mysql driver (usually labeled php#-mysqlnd, where # is your version)
- A MySQL database
- [Technic Solder](https://solder.io) and associated database tables
- Knowledge of how to operate Apache/Nginx/Lighttpd/IIS

## Installing
Simply navigate to the directory you wish to install EZSolder in and run

`git clone https://github.com/Flawedspirit/EZSolder.git`

## Setup
After installation, you'll want to edit **includes/config.php** and input the right information.

## Usage
If everything went right, you'll be at the uploader page. The fields are for the most part self-explanatory, but some things to mention are:
- Mod name and mod author only need to be specified if a **new** mod is being added to the repo.
- A mod slug, version, a file to upload, and the destination always need to be specified.
- Standard destinations (mods, configs, etc.) can be selected, or a custom location can be entered if your file needs to go elsewhere, e.g. liteconfigs, resourcepacks, scripts, etc.
- Some mods are split into multiple jars (Project Red comes to mind). To avoid having to upload multiple files, you can create a .zip file on your computer and upload that instead of multiple files.
- NOTE: EZSolder does not currently support uploading multiple files, as browser support for such a basic function is surprisingly iffy.

## Support
Something wrong or missing? Please open an issue [here](https://github.com/Flawedspirit/EZSolder/issues) and I will endeavor to fix it or add it. Please note that this was mostly a personal project and I consider it somewhat feature complete at this point in time. However, if something's broken or if I *really* like an idea, I will totally consider it!

Alternatively, you can just make a pull request, because that is how git works.
