# E1 - Portfolio

E1 Blokstart assignment, project chosen is portfolio website.

# Code Conventions

-   BEM Architecture for div structure.
-   Tabs for indentations
-   Tailwind in .scss file
-   Almost every line should end in a semicolon. Don't rely on semicolon-insertion.
-   Naming
    -   Controllers: Singular (Ex: ArticleController)
    -   Model: Singular (Ex: Article)
    -   Route: Plural (Ex: Articles/1)
    -   View: kebab-case (Ex: create-article.blade.php)
    -   Variable: camelCase (Ex: articleTitle)

# How to start using this project

1. Fork this project from github
2. Put it in your desired folder
3. Open your ternimal
4. Do a <code>composer install</code>
5. Do a <code>copy .env.example .env</code>
6. Edit the .env to fit your information
7. Open your ternimal again, and fill out these commands

    - <code>php artisan key:generate</code>
    - <code>php artisan migrate</code>
    - <code>php artisan migrate:fresh --seed</code>
    - <code>npm install</code>
    - <code>npm run dev</code>
    - <code>php artisan serve</code>

8. Now you can see the overview, start testing it
9. Want to see the admin dashboard?
    1. Go to '/login'
    2. Login with:
        - email: testaccount@test.nl
        - password: password
    3. And start testing. You can see, create, edit and delete projects.

-   Questions, something not working? Ask me. Here are some questions you may have
    -   Styling not working?
        -   Try <code>npm install -d sass</code>
    -   Can you make an account?
        -   No there is no way to go to the register form.
