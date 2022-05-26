<strong>Description</strong>
<p>This assignment was built using Laravel for the backend and parts of the front end get and post request from the front-end were handles with vue.js.</p>

<p>To setup, run migration and db seeder to populate the database</p>

<p>The relevant models/tables are the User and BlogPost. The relevant controllers include RegisterController, LoginController, AccountController, AdminAccountController, HomeController.</p>

<p>The relevant vue.js components include CreatePost, HomePosts, LoginUser, RegisterUser </p>

<strong>Home page</strong><br>
<p>The Homepage loads all posts made by both admin and the users, the sort by recent button on the homepage orders the posts by recently published. The recently published and recently created have separate fields. The posts from the home page are gotten from the server using Laravel for better pagination and SEO but displayed using vue.js for better DOM manipulation.</p>

<strong>Registration and Login</strong><br>
<p>A new member signs up and must approve their account by clicking on an email verification link sent to their email. In the user database table, the verified members are assigned by a ‘verified’ field using ‘1’ for verified and ‘0’ unverified. Unverified members are unable to login unless they vet verified.</p>

<strong>Dashboard:</strong>
<p>After login, members can access their dashboard and submit posts, posts can be set as draft or published. Published posts are displayed on the home page while drafts are hidden and seen by only the members.
All post submissions are validated from the front-end using vue.js and the backend using Laravel validation. Submission of posts are made using the API post request via Vue.js</p> 

<strong>Admin</strong>
<p>The admin is the only ones that can get new posts from the API submitted. The admin users are assigned by the ‘admin’ column using ‘1’ for admin and ‘0’ for non-admin.<p>

<strong>Test</strong>
<p>Tests were being conducted using factories, seeders and feature testing. There are 2 types of test files, Post Test and User Test. The user test asserts the registration, login and authentication of the website, while the Post test asserts the submission of posts by logged in members.</p>

<strong>Note</strong>
<p>I could have done a lot more feature test if given more time due to my on-going company tasks.</p>
