Feature: Get extension
	Get extension of a federated authenticated user

	Scenario: Get extension of a@a.hu
	   Given the database is clean
		When I send a GET request to "/getExtension/a@a.hu"
		Then the JSON node "data.extension" should contain "2000"

	Scenario: Get extension of a@a.hu again
		When I send a GET request to "/getExtension/a@a.hu"
		Then the JSON node "data.extension" should contain "2000"

	Scenario: Get extension of b@a.hu
		When I send a GET request to "/getExtension/b@a.hu"
		Then the JSON node "data.extension" should contain "2001"
	
	Scenario: Get a new extension
		When I send a GET request to "/getExtension/c@a.hu"
		Then the JSON node "data.extension" should contain "2002"

	Scenario: Get the last extension
	    Given there are extensions:
            | nameId     | extension    | lastLogin   |
            | d@a.hu   | 9998         | 2015-10-19  |
		When I send a GET request to "/getExtension/e@a.hu"
		Then the JSON node "data.extension" should contain "9999"

	Scenario: There is no more extension
		When I send a GET request to "/getExtension/f@a.hu"
		Then response status code should be 507

	Scenario: Clean the database
	   Given the database is clean
	