## :rocket: Laravel Test
This project is a Laravel application that sources articles from a news site, saves them in a MySQL database and supplies an endpoint to access the articles. This project uses various Laravel features to accomplish this functionality: Cache, Form Requests, Api Resources, etc.

### :computer: Installation 

To install the application, follow these steps:

1.  Clone the project from GitHub to your local machine.
2.  Navigate to the project directory and run `composer install` to install the required dependencies.
3.  Create a new database in MySQL for the application.
4.  Create a copy of the `.env.example` file and rename it to `.env`. Update the database credentials in this file to match your MySQL database.
5.  Run `php artisan key:generate` to generate a new encryption key for the application.
6.  Run `php artisan migrate` to run the database migrations and create the necessary tables.
7.  Start the development server by running `php artisan serve`.
9.  You can now access the api at `http://localhost:8000/api`.

### :gear: Usage 

The application provides two endpoints:

#### `POST /api/articles/import?siteRssUrl`

This endpoint imports articles from the specified RSS feed URL and saves them in the database. To use this endpoint, send a POST request to `/api/articles/import` with the `siteRssUrl` parameter set to the URL of the RSS feed. For example:


`POST http://localhost:8000/api/articles/import siteRssUrl=https://www.lemonde.fr/rss/une.xml` 

#### `GET /api/articles`

This endpoint returns a list of all the articles in the database. Each article is represented as a JSON object with the following properties:

-   `id`: The unique ID of the article in the database.
-   `externalId`: The ID of the article in the RSS feed (if available).
-   `importDate`: The date and time when the article was imported into the database.
-   `title`: The title of the article.
-   `description`: The description of the article.
-   `publicationDate`: The date and time when the article was published.
-   `link`: The URL of the article.
-   `mainPicture`: The URL of the main picture in the article.

### Optional Feature

The application also provides an optional feature where, for each article in the response to the `/api/articles` endpoint, the word with the most vowels in the title is included. If two or more words have the same number of vowels, the longest word is included.

###  :white_check_mark: Testing 

To run the tests for this app, run the following command in the project root: 

`vendor/bin/pest` 

This will run all the tests in the `tests` directory.
###  :microscope: API Documentation  
ThunderClient is a popular REST client for testing and documenting APIs, and it allows you to import API documentation from a JSON file. Here are the steps to import a JSON file into ThunderClient:

1.  Open ThunderClient and click on the "Import" button on the top right corner of the screen.
2.  In the "Import" dropdown menu, select "Import from OpenAPI (Swagger) or JSON file".
3.  In the "Import from JSON" window, click on the "Choose File" button and choose `thunder-collection_RSS Feed Reader.json.` 

4.  Select the JSON file you want to import and click on the "Open" button.
5.  ThunderClient will then parse the JSON file and display the available endpoints and methods.
6.  Set the base url in the collection settings to `http://localhost:8000/api` 
7.  Save the imported API documentation as a collection in ThunderClient.

That's it! You should now have your API documentation imported into ThunderClient and be ready to test your API endpoints.

## :tada:Conclusion 

That's it! You should now have a fully-functional Laravel app that can import articles from a news website and display them on another endpoint. :smile:

##  💬Contact

If you have any questions or comments about this project, please feel free to contact us at `hayk.rekik@gmail.com`. We'd love to hear from you! 