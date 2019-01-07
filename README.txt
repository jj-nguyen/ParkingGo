Name: Jay Nguyen
Student #: 1327828

TODO:

Domain URL: http://ec2-52-15-33-186.us-east-2.compute.amazonaws.com/search.php

1. Let's Encrypt no longer gives out certificates to domains ending in amazonaws.com.
Furthermore, Amazon's certificate manager refuses to give them to domains ending in amazon.aws.com as well.
Hopefully minimal marks will be deducted because of this fact as the process was almost complete and given
the fact that we are REQUIRED to use AWS.

I believe this cannot be circumvented without buying a domain and hosting it through AWS' services.

An SSL.png file is attached to this archive to document this.

Due to an unsecured connection on the deployed website, you cannot use geolocation with Chrome because the connection is not secure.
For this, I recommend just using files within the archive or a different browser such as Mozilla Firefox to test if geolocation works instead.

3. Sometimes the map does not load. Just refresh the page.

4. Some files within the img folder cannot be accessed for some reason. This will be reflected on some of the pages on the deployed site.

5. The parking submission link only appears if the user is logged in. Same goes for review submissions.

6. A couple users were pre-made. Login with these credentials.

  Email: nguyej48@mcmaster.ca
  Password: password1

  Email: test@test.com
  Password: password1

7. The user is able to uploaded an image with parking submission. Don't know where within the server it is uploaded, but the code is there.
No errors are caught so it should be functioning.

8. After a successful submission of a parking, review, or user, you get redirected to the search page. Just navigate back.

9. Searching by location, via latitude and longitude, uses LIKE "string%". So you don't need exact decimals.
