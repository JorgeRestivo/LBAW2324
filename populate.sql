INSERT INTO "User" ("username", "name", "e-mail", "password", "userStatus")
VALUES
  ('user1', 'User One', 'user1@example.com', 'password1', 'Active'),
  ('user2', 'User Two', 'user2@example.com', 'password2', 'Active'),
  ('user3', 'User Three', 'user3@example.com', 'password3', 'Active');
INSERT INTO "Event" ("eventName", "startDateTime", "endDateTime", "registrationEndTime", "local", "description", "capacity", "isPublic", "status")
VALUES
  ('Event 1', '2023-10-30 10:00:00', '2023-10-30 12:00:00', '2023-10-30 09:30:00', 'Location A', 'Description for Event 1', 100, true, 'OpenToRegistrations'),
  ('Event 2', '2023-11-15 14:00:00', '2023-11-15 16:00:00', '2023-11-15 13:30:00', 'Location B', 'Description for Event 2', 50, true, 'OpenToRegistrations'),
  ('Event 3', '2023-12-05 18:00:00', '2023-12-05 20:00:00', '2023-12-05 17:30:00', 'Location C', 'Description for Event 3', 75, true, 'OpenToRegistrations');
INSERT INTO "EventInvitation" ("userInvited", "sentDate", "inviteResponse")
VALUES
  (1, '2023-10-25 15:00:00', 'I''m going'),
  (2, '2023-11-05 12:00:00', 'I''m thinking'),
  (3, '2023-12-01 16:00:00', 'I''m not going');
INSERT INTO "Tag" ("name")
VALUES
  ('Tag 1'),
  ('Tag 2'),
  ('Tag 3');
INSERT INTO "Attendance" ("participation", "whishlist")
VALUES
  ('I''m going', true),
  ('I''m going', false),
  ('I''m not going', false);
INSERT INTO "Comments" ("content", "dateTime")
VALUES
  ('Comment 1 for Event 1', '2023-10-30 10:30:00'),
  ('Comment 2 for Event 1', '2023-10-30 11:15:00'),
  ('Comment 1 for Event 2', '2023-11-15 14:30:00');
INSERT INTO "Notifications" ("date", "viewed")
VALUES
  ('2023-10-25 08:00:00', false),
  ('2023-10-26 11:30:00', true),
  ('2023-11-01 16:45:00', false);
INSERT INTO "EventTicket" ("eventID", "price", "ticketNumber")
VALUES
  (1, 20, 100),
  (1, 15, 50),
  (2, 30, 75);
INSERT INTO "EventNotification" ("eventID", "content")
VALUES
  (1, 'New notification for Event 1'),
  (2, 'New notification for Event 2'),
  (3, 'New notification for Event 3');
INSERT INTO "UserNotification" ("userID", "content")
VALUES
  (1, 'Notification for User 1'),
  (2, 'Notification for User 2'),
  (3, 'Notification for User 3');
INSERT INTO "CommentNotification" ("commentID", "content")
VALUES
  (1, 'Notification for Comment 1'),
  (2, 'Notification for Comment 2'),
  (3, 'Notification for Comment 3');
