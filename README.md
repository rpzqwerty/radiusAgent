# RadiusAgent
 Search Algorithm with match Score
 
 
 # Funtionality
Efficient algorithm that helps determine a list of matches with match percentages for each match between a huge set of properties (sale and rental) and buyer/renter search criteria as and when a new property or a new search criteria is added by an agent. 

# Searching
The logic for searching can be found in the controller: SearchController.
Search Parameters are:

•	Distance - radius (high weightage)

•	Budget - (high weightage)

•	Number of bedrooms  -(low weightage)

•	Number of bathrooms - (Low weightage)

# Matching
•	Each match has a percentage that indicates the quality of the match. Ex: if a property exactly matches a buyers search requirement       for all 4 constraints mentioned above, it’s a 100% match.  

•	Each property has these 6 attributes - Id, Latitude, Longitude, Price, Number of bedrooms, Number of bathrooms

•	Each requirement has these 9 attributes - Id, Latitude, Longitude, Min Budget, Max budget, Min Bedrooms required, Max bedroom           required, Min bathroom required, Max bathroom required.

# Functional Requirements

•	All matches above 40% are only considered useful.

•	Requirements can be without a min or a max for the budget, bedroom and a bathroom but either min or max would be present.

•	For a property and requirement to be considered a valid match, distance is within 10 miles, the budget is +/- 25% , the numbers of         bedroom and bathroom is +/- 2.

•	If the distance is within 2 miles, distance contribution for the match percentage is fully 30%

•	If the budget is within min and max budget, budget contribution for the match percentage is full 30%. If min or max is given by the         user, +/- 10% budget given by the user is a full 30% match.

•	If bedroom and bathroom fall between min and max, each will contribute full 20%. If min or max is not given, match percentage varies       according to the value.


