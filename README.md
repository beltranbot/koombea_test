# Requirements
- Docker
- Docker Compose

# Local Environment set up
 1. clone the repository
    ```shell
        git clone https://github.com/beltranbot/koombea_test.git
    ```
 2. Create and configure the .env file within the project, this will hold the information for the database connection and other aspects of the application
 3. Install dependencies using the composer utility images included
    ```shell
        docker build -t composer ./docker/composer/Dockerfile
        docker run composer install
    ```
 4. With the dependencies installed you can build the application images using [Laravel Sail](https://laravel.com/docs/8.x/sail), this process can take several minutes the first time it's executed.
    ```shell
        sail build
    ```
 5. Once the images have been build, you can start the local application using:
    ```shell
        sail up
    ```
 6. You can change the application port (APP_PORT) and database configuration by edition the .env file and editing the docker-compose.yml files.
 7. create the application key
    ```shell
        sail artisan key:generate
    ```
 8. run the migrations
    ```shell
        sail artisan migrate
    ```
 9. run the seeder
    ```shell
        sail artisan db:seed --class=ContactFileStatusSeeder
    ```
 10. Create a passport password client, the client_id and client_secret will be used to communicate with the application
    ```
        sail artisan passport:client --password
    ```
 9. After you are ready to go, you can find a test file in the test_file/ folder

# Available endpoints

### Create user POST /api/users
 - Creates a user with an username and password.
 ```json
{
    "username": "admin",
    "password": "password"
}
 ```

### Login user POST /oauth/token
 - checks the user credentials and returns a valid token that can used with authenticated endpoints
```json
 {
    "grant_type": "password",
    "client_id": "1", // your client_id
    "client_secret": "<client_secret>", // your client_secret
    "username": "admin", // user_id you which to login as
    "password": "password" // password of the user
}
```
 - a valid answer looks as follows
```json
{
    "token_type": "Bearer",
    "expires_in": 31535999,
    "access_token": "<bearer_token>",
    "refresh_token": "<refresh_token>"
}
```
 - to user the authenticated endpoints, on your request you have to set the Authentication header with the contect "Bearer <access_token>"

### upload contacts file POST /api/contacts/upload
 - this endpoint requires authentication
 - uploads a csv file for later processing
 - postman request example:
```bash
curl --location --request POST 'localhost:80/api/contacts/upload' \
--header 'Authorization: Bearer <access_token>' \
--form 'file=@"<path/to/the/file>"'
```

### list contact files GET /api/contacts/files
 - this endpoint requires authentication
 - list of all contact files that have been uploaded by the authenticated user pagintated by 10 elements
```
    localhost/api/contacts/files
```
### list contact file errors GET /api/contacts/files/{contact_file_id}/errors
 - this endpoint requires authentication
 - list of all the errors assocciated with a given contact file, paginated by 10 elements. Only the user that uploaded the file can see the related errors.
```
    localhost/api/contacts/files/{contact_file_id}/errors
```
