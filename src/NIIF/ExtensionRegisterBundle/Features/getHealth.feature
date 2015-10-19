Feature: Get health
	In order that monitor the application the system has to response
	the status of the remaining extensions.

	Scenario: Get many remaining extensions
	   Given the database is clean
	    Then there are extensions:
            | nameId     | extension    | lastLogin   |
            | a@a.hu     | 2000         | 2015-10-19  |
		When I go to "/getHealth"
		Then the response should contain "7998"

	Scenario: Get only one remaining extension
	   Given there are extensions:
            | nameId     | extension    | lastLogin   |
            | b@a.hu     | 9998         | 2015-10-19  |
		When I go to "/getHealth"
		Then the response should contain "1"

	Scenario: Get no remaining extension
	   Given there are extensions:
            | nameId     | extension    | lastLogin   |
            | c@a.hu     | 9999         | 2015-10-19  |
		When I go to "/getHealth"
		Then the response should contain "0"

	Scenario: Clean the database
	   Given the database is clean
	