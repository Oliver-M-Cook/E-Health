Web Design and Development	
E-Health 1CWK100		
Oliver Cook

The database is unchanged so the default sql file will work

The admin account has to be in the GUID 1
The system isn't flexible with admin accounts, they have to be hard coded into the system

Once you sign up, you will be redirected to the welcome page
you can then login using the other button

The admin account can view the questionaire list, and see the graphs.
The graphs only display data if a patient has submitted a questionaire
The admin will not be able to view the questionaire list if there is no questionaires

The system will class a user with no 'status' set as a new user
This will allow them to complete the questionaire with the 'complete questionaire' button
Once the user completes the questionaire, the button will update to 'update questionaire'
It will also display the application status on the dashboard too.

If the patient or admin update the questionaire, the status will be set to pending
The admin will have to view the questionaire and accept or reject at the bottom of the page
Once the application is accepted, the admin can update the questionaire.

There are 4 graphs in total, which consist of:
	-Application Counter so the admin can see the status' of the questionaires
	-Age Groups Average Audit Score
	-Patient Smoking so the admin can see if more people are smoking, or not smoking
	-Patient Diet so the admin can see the trends in patients diets			