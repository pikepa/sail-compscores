# Compscores Todos

## Client Users
A user can have many clients and clients many users ('client_user').
- other than the client Owner (which is 1:M).
- First invite a user from clienthome.
- When accepted add user to client_users with role for this client. 
    - Use the client_user table to record this clients role from invitation,
- Then set the role ( assignRole() at the point of client selection).
    - Store client_id in Session variable

