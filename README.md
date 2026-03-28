![GitHub repo file count](https://img.shields.io/github/directory-file-count/shz-code/triptrip)
# Triptrip - Travel Agency Solution

Triptrip is fullstack website that handles management of various tour and travel packages. 
- Users can **browse**, **search**, **buy** packages therefore generate **pdf reports**, write **reviews** and everything is done in realtime.
- Admin user can manage **users**, **tour packages**, **sales**, generate **pdf reports** accordingly.
- Raw PHP is used to script the backend.

## Key Features
### Users
- User validation added on login and sign up. Username and email fields are unique. User will get mail after completing registration when SMTP credentials are set in `.env`.

- Package purchase validation added. One user can not purchase same package twice, can not purchase after package has started and also can not purchase after package capacity is full.

- User will get email after completing purchase when SMTP credentials are set in `.env`.

- User can write review and generate pdf report after purchasing any package and *more*.

### Admin

- View, add, modify  packages.
- Manage users. (Active/Inactive)
- View and generate pdf report on sales.

## Known Bugs

Checkout the **dbConnection.php** file for the known bugs. 


# Getting Started

Clone the repository

```bash
  git clone https://github.com/shz-code/triptrip.git
```

## Prerequisites

You need to have a PHP enabled apache with mysql server installed on your local device.

You can use -
- [XAMPP](https://www.apachefriends.org/index.html)
- [Laragon](https://laragon.org/)

Code editor -
- [Vscode](https://code.visualstudio.com/)
- [PhpStorm](https://www.jetbrains.com/phpstorm/)

## Installation

- Start Apache and Mysql.
- Extract downloaded project file
- Rename the extracted folder to **triptrip**.
- Copy the extracted folder to htdocs(XAMPP) or www(Laragon) folder.
- Create a new database named **triptrip** and create required table. Use the [tableSchemas](./tableSchemas.txt) to create tables.

- Copy `.env.example` to `.env` and fill in your values (see [Environment Variables](#environment-variables) below).

- Open your browser and go to [http://localhost/triptrip](http://localhost/triptrip)

- Go to register and sign up using new user.
- To make a user admin go to your database -> triptrip -> users -> **set *is_admin* to 1**.
- Separate dashboards for **admin** and **users**. Use **admin** dashboard to start adding new packages.

## Environment Variables

This project uses a `.env` file in the project root for secrets and environment-specific config. Copy `.env.example` to `.env` and fill in the values:

```env
APP_URL=http://localhost

SSLCOMMERZ_STORE_ID=your_sslcommerz_store_id
SSLCOMMERZ_STORE_PASSWD=your_sslcommerz_store_password

SMTP_USERNAME=your_email@gmail.com
SMTP_PASSWORD=your_gmail_app_password
```

| Variable | Description |
|---|---|
| `APP_URL` | Base URL of the app (no trailing slash), e.g. `http://localhost` |
| `SSLCOMMERZ_STORE_ID` | Your SSLCommerz sandbox/live store ID |
| `SSLCOMMERZ_STORE_PASSWD` | Your SSLCommerz store password |
| `SMTP_USERNAME` | Gmail address used to send emails via PHPMailer |
| `SMTP_PASSWORD` | Gmail [App Password](https://support.google.com/accounts/answer/185833) (not your account password) |

> `.env` is gitignored and will never be committed. `.env.example` is committed as a template.

**Email sending** is automatically enabled when `SMTP_USERNAME` and `SMTP_PASSWORD` are set. If they are empty, mail steps are silently skipped.

# Please note

- All the SQL codes are written in **_dbConnection.php** file.
- The file structure is modular. You will get a `components/` folder containing common HTML for all pages (head, header, footer).
- This project uses **SSLCommerz** sandbox as payment gateway. Set `SSLCOMMERZ_STORE_ID` and `SSLCOMMERZ_STORE_PASSWD` in `.env`. Visit [SSLCommerz](https://developer.sslcommerz.com/) to know more.

## Screenshots
- Search for desired package directly from landing page based on location
![Landing Page](./assets/github_images/landing_page.jpeg)
- Get all listed packages or search for desired package based on location
![Package Listings](./assets/github_images/package_listings.jpeg)
- Updated package rating after user review
![Package Ratings](./assets/github_images/package_ratings.jpeg)
- Optional available package features
![Package Features](./assets/github_images/package_features.jpeg)
- User reviews
![Package Review](./assets/github_images/package_review.jpeg)
- Admin Dashboard to control the website
![Admin Dashboard](./assets/github_images/admin_dashboard.jpeg)
- User dashboard to control user info and purchase info
![User Dashboard](./assets/github_images/user_dashboard.jpeg)
- SSL Commmerz payment gateway for completing purchase
![Payment Gateway](./assets/github_images/payment_gateway.jpeg)

# Built With
![](https://img.shields.io/badge/Code-PHP-informational?style=flat&logo=php&logoColor=white&color=green) The scripting language used


![](https://img.shields.io/badge/Database-MySQL-informational?style=flat&logo=mysql&logoColor=white&color=green)
The relational database management system used

# Authors
**Shahidul Alam** - [@shz-code](https://github.com/shz-code)

**Akibul Hasan** - [@MdAkibulHasan](https://github.com/MdAkibulHasan)

# License
[![MIT License](https://img.shields.io/badge/License-MIT-green.svg)](https://choosealicense.com/licenses/mit/)

This project is licensed under the MIT License - see the LICENSE file for details
# Acknowledgments
- Design Inspired
