# SOS (Faroos law firm - Suhrawardi Online System)

Suhrawardi Online System (SOS) is a web-based application for law firms to maintain their office. This software is designed to be easy to operate and a light system tool to maintain information about Clients, Cases, Hearings, etc.

For more detailed original documentation (which may refer to the system by a generic name), please see [Documentation/index.html](Documentation/index.html).

## Server Requirements

- Local Server: [XAMPP](http://www.apachefriends.org/en/xampp.html), [WAMP](http://www.wampserver.com/en/), [AMPPS](http://www.ampps.com/), or any Apache with PHP and MySQL server.
- Mod Rewrite Enabled.
- Live server (preferably a sub-domain).

## Installation Guide

SOS comes with a Web Installation Page. Once your environment is ready, follow this quick guide:

1.  Download a copy of SOS.
2.  Extract the file `AOMS-[VERSION]-.zip` (the original archive name might still reflect the generic version) to the `htdocs` folder in XAMPP or `www` folder in WAMP. If installing on your Online Server, upload it as a ZIP file using FTP and extract it to a folder on your Live Server.
3.  Open your favorite MySQL Administration tool (e.g., PHPMyAdmin) and create a database (Example: `SOS_DB` or a name of your choice).
4.  Open your favorite browser and type in the address bar `http://your-domain.com/FOLDERNAME`.
5.  Enter your MySQL host, Database Name, MySQL Username, and Password. Then Click on "Install".
6.  On the next screen, register an Admin for the application using Name, Username, Password, and Email.
7.  Login using your admin credentials.
8.  If you can't access the login page or get an error "No file input selected", check your `.htaccess` file and that Mod_Rewrite is enabled.

*(Installer images referenced in the original documentation can be found in the `Documentation/assets/images/` directory: `installer.png`, `register.png`, `login.png`)*

## System Settings

The following settings are available in SOS:

### General Settings

-   **Company Name:** Your company/firm name.
-   **Logo:** Your company/firm logo.
-   **Header Settings:** What you want to show in the header (logo or company name).
-   **Address:** Your company's address.
-   **Phone:** Your company's phone.
-   **Email:** Your company's email ID.
-   **Default Date Format:** Which date format you want to use in the application.
-   **Timezone:** Which timezone you want to use in the application.
-   **Invoice No Start From:** Initial number of the invoice.

### HR Settings

-   **Employee Default Mark Out Time:** Default time considered when an employee is automatically marked out.
-   **Employees Id Start From:** Employee ID starting number.
-   **Working Days:** Company working days.

### SMTP Settings

-   **SMTP HOST:** The SMTP Host if using SMTP.
-   **SMTP USER:** Your SMTP username.
-   **SMTP PASSWORD:** Your SMTP Password.
-   **SMTP PORT:** Your SMTP Port number (Usually 25).

### Notification Settings

-   **Case Alert Days:** Number of days prior to get a case alert.
-   **To Do Alert Days:** Number of days prior to get a ToDo alert.
-   **Appointment Alert Days:** Number of days prior to get an appointment alert.

### Adding a new Language to the System

1.  Go to Administrative -> Language.
2.  Enter Language Name, Icon, and Language File.
3.  Click on Save.

**Note:** For the Language file, you can download the sample English file and save that with a different language.

---

Developed and customized by: Amid Ahadi
- Email: amid.ahadi@gmail.com
- Website: [c-security.ir](http://c-security.ir)

For full details from the original system, please refer to the documentation in the `Documentation` folder, specifically [Documentation/index.html](Documentation/index.html).
