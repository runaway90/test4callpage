<main role="main" class=" pt-5 inner cover">
                    <h1 class="cover-heading">Test application for CallPage</h1>
                    <p class="lead text-info">Application with REST API where You can create TEAM, EMPLOYER and WORKING_LIST(add new work hours for employer). Also You can send request(with team, date and super_number) and take response with information about working hours in ONLY working days, how long as super_number sended.
                    </p>
                    <p class="lead">Stages for local use:
                    </p>
                    <p class="lead">
                        <ul class="list-group">
                                <li class="list-group-item">Create directory in You local computer. Enter in this directory.</li>
                                                        <li class="list-group-item">Clone project from git."git clone https://github.com/runaway90/test4callpage.git". Enter in this directory.</li>
                                                        <li class="list-group-item">Run commands "composer install" and "cp .env.example .env"(for make file .env).</li>
                                                        <li class="list-group-item">Change permission to all repository and files in project for You local user(chown)</li>
                                                        <li class="list-group-item">Create new database(for example in MySQL). Add database info in file ".env", like as:
                                    <h6 class="alert-success"><br>DB_CONNECTION=mysql
                                    <br>DB_HOST=127.0.0.1
                                    <br>DB_PORT=3306
                                    <br>DB_DATABASE={db_name}
                                    <br>DB_USERNAME={user}
                                    <br>DB_PASSWORD={password}</h6>
                                </li>
                                <li class="list-group-item">Run command "php artisan key:generate"</li>
                                                        <li class="list-group-item">Run commands " php artisan migration"(for create tables) and "php artisan db:seed"(for import test date in tables)</li>
                                                        <li class="list-group-item">Run application "php artisan serve" and open browser on route "http://127.0.0.1:8000/"</li>
                                                        </ul>
                    </p>
                    <p class="lead">Routes and functional controllers</p>
                <p class="lead">
                <ul class="list-group">
                    <li class="list-group-item">post('/create_team', 'WorkProcessController@createTeam'</li>
                    <li class="list-group-item">post('/create_employer', 'WorkProcessController@createEmployer)</li>
                    <li class="list-group-item">post('/work_list', 'WorkProcessController@workInThisTeamInThisDay')</li>
                    <li class="list-group-item">post('/add_work_hours_to_employer', 'WorkProcessController@addNewWorkingHours')</li>
                    <li class="list-group-item">get('/get_all_working_data', 'WorkProcessController@getAllWorkingData')</li>
          
</ul>
                </p>
                                    <p class="lead">Testing photos</p>
                # Create new team <img src="/resources/photo/create_new_team.png" alt="Test">
                # Create new employer <img src="/resources/photo/add_new_employer.png" alt="Test">
                # Add new work hours <img src="/resources/photo/add_new_work_hours.png" alt="Test">                
                # Get all records from Working List <img src="/resources/photo/get_all_records_from_working_list.png" alt="Test">
                                                   <p class="lead">SUPER NUMBER</p>
                # Work list <img src="/resources/photo/work_list1.png" alt="Test">
                # Work list <img src="/resources/photo/work_list2.png" alt="Test">
                # Work list <img src="/resources/photo/work_list3.png" alt="Test">
                           </main>
