# Senior Developer Assessment with Apimedic API

Using Boostrap as the front-end framework and Laravel as the 
backend framework and based on an MVC architecture, a toy web app was developed for diagnosis using a publicly available
medical diagnosis API from https://apimedic.com/

The app uses **MySQL as it's database**
> The database configuration can be seen in the **env** file

The app consists of 3 simple pages

1. First page consists of a form to collect patient’s symptoms. On this page, a drop down is used to pull symtoms name and their ID from the apimedic API
2. Second page consists of a boostrap responsive table to show the list of possible diagnosis, as returned from the API, about the symtoms provided in page 1
    On the second page where the table is shown, patient can decide to mark the diagnosis as valid or invalid which is stored in the database
3. The third page simply displays a message to patient about the action made in page 2 of the app.
 
