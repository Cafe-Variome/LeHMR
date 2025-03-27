# Leicester Health & Medical Data for Research (LeHMR)

Leicester researchers and clinicians have produced a large number of biomedical datasets from cohort studies, clinical trials, healthcare practice, and audit projects. These constitute a valuable resource that can be shared to facilitate new analyses and original discoveries.

To maximise their wider/secondary use responsibly, NIHR Leicester BRC and HDR UK Leicester have established the **"Leicester Health & Medical Data for Research" (LeHMR)**. This platform will list the wealth of local academic and healthcare datasets that researchers can request access to. This work operates in synergy with the [HDR UK Innovation Gateway](https://healthdatagateway.org/en).

"LeHMR Online" is a simple platform that enables PIs, or nominated members of their team, to manage/submit metadata about their datasets (e.g., description, researchers, publications, data use conditions) so that they can be easily discovered by internal and external researchers.

Leicester investigators are therefore now invited and encouraged to use LeHMR (with support available from the BRC and HDR UK informatics teams) to provide core metadata and make this visible from the LeHMR platform. Investigators have the option to request that their datasets be also made visible from the national HDR UK Innovation Gateway.

For further details about LeHMR please contact **[Dr. Anthony Brookes](mailto:ajb97@leicester.ac.uk)**. For technical assistance or to get help to use the interface please contact **[Umar Riaz](mailto:ur13@leicester.ac.uk)**.


Access the tool at: [LeHMR](https://lehmr.le.ac.uk/)



## Technology Stack

The **DUC Profile Creator** is developed using **CodeIgniter**, a lightweight and flexible PHP full-stack web framework known for its speed, security, and scalability. Learn more about CodeIgniter at the [official website](http://codeigniter.com).

---

## Development Guide

### Server Requirements

Ensure your server meets the following prerequisites:

- **PHP** version **7.3** or higher, with the following extensions installed:
  - [intl](http://php.net/manual/en/intl.requirements.php)
  - [libcurl](http://php.net/manual/en/curl.requirements.php) (Required for HTTP\CURLRequest library)
  - **Required PHP extensions (enabled by default in most setups):**
    - JSON
    - [mbstring](http://php.net/manual/en/mbstring.installation.php)
    - [mysqlnd](http://php.net/manual/en/mysqlnd.install.php)
    - XML

### Installation & Setup

To set up the application, follow these steps:

1. **Clone the repository**:

   ```bash
   https://github.com/Cafe-Variome/LeHMR.git
   ```

2. **Navigate to the project directory**:

   ```bash
   cd LeHMR
   ```

3. **Install dependencies using Composer**:

   ```bash
   php composer install
   ```

4. **Set up environment variables**:

   - Copy `env` to `.env` and configure the settings, including the base URL and database credentials.

5. **Database Configuration**:

   - import `LeHMRschema.sql` into your database.
   - Configure database settings in `.env` or `app/config/Database.php`.

### Support & Contact

For setup-related inquiries, please contact **[Umar Riaz](mailto:ur13@leicester.ac.uk)**.

---

### Contribution & Future Development

We welcome contributions to improve and extend this tool. If you encounter any issues or have suggestions, feel free to submit a pull request or reach out to the maintainers.

---

This project is developed and maintained to maximise wider/secondary use of discoveries in a responsible manner. We appreciate your support and feedback!
