# Compscores

### What is it ?
Compscores is an application wich allows a gym or Crossfit Box to create competitions and collect results for the events in the competition in real time, with real time updates to the overall positions as results are entered.

### Features
Features include the following:-
    * The registration of an owning organisation by a **SuperAdmin**.
        - An organisation or client is linked to a specific User as the Owner. 
    + The registration of users and roles for the organisation (client) by a **ClientAdmin**.
    + The creation of competitions and client Users (via email invitations) for a specific client.
        - Note an email address (user) may be registered for multiple organisations via the 'client_user' relationship, but will only see information for the client selected after login.
    - The creation of events for a competition, with the ability to specify scoring methods for that event.
    - The creation of atheletes or teams to participate within a competition, including different levels of skill (RX etc) or age groups