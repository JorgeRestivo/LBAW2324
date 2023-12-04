--
-- Use a specific schema and set it as default - thingy.
--
DROP SCHEMA IF EXISTS lbaw2321 CASCADE;
CREATE SCHEMA IF NOT EXISTS lbaw2321;
SET search_path TO lbaw2321;
SET DateStyle TO European;

--
-- Drop any existing tables.
--
DROP TABLE IF EXISTS users CASCADE;
DROP TABLE IF EXISTS events CASCADE;
DROP TABLE IF EXISTS eventInvitation CASCADE;
DROP TABLE IF EXISTS eventTicket CASCADE;
DROP TABLE IF EXISTS tag CASCADE;
DROP TABLE IF EXISTS comments CASCADE;
DROP TABLE IF EXISTS attendance CASCADE;
DROP TABLE IF EXISTS notification CASCADE;


DROP TYPE IF EXISTS user_status_types;
DROP TYPE IF EXISTS event_status_types;
DROP TYPE IF EXISTS invite_response_type;
DROP TYPE IF EXISTS tag_type;
DROP TYPE IF EXISTS notification_type;


--
-- Create types.
--

CREATE TYPE user_status_types AS ENUM ('Active', 'Suspended', 'Banned');
CREATE TYPE event_status_types AS ENUM ('Active', 'Suspended', 'Banned');
CREATE TYPE participation_type AS ENUM ('Going','Maybe','Not Going');
CREATE TYPE tag_type AS ENUM ('Outdoor','Indoor','Music','Tech','Fitness','Education','Art','Science','Food','Travel','Gaming','Fashion');
CREATE TYPE notification_type AS ENUM ('event_notification','comment_notification');


--
-- Create tables.
--

CREATE TABLE users (
  id SERIAL PRIMARY KEY,
  username VARCHAR(256) UNIQUE NOT NULL,
  name VARCHAR(256) NOT NULL,
  email VARCHAR(256) UNIQUE NOT NULL,
  password VARCHAR(256) NOT NULL,
  userStatus user_status_types NOT NULL DEFAULT 'Active',
  profile_photo VARCHAR(255) DEFAULT 'default-profile-photo.jpg',
  isAdmin BOOLEAN DEFAULT FALSE
);

CREATE TABLE tag (
  id SERIAL PRIMARY KEY,
  name tag_type NOT NULL
);

CREATE TABLE events (
  id SERIAL PRIMARY KEY,
  eventName VARCHAR(256) NOT NULL,
  startDateTime TIMESTAMP NOT NULL,
  endDateTime TIMESTAMP NOT NULL,
  registrationEndTime TIMESTAMP NOT NULL,
  local VARCHAR(256) NOT NULL,
  description VARCHAR(512) NOT NULL,
  capacity INTEGER NOT NULL CHECK (capacity>0),
  isPublic BOOLEAN NOT NULL DEFAULT TRUE,
  status event_status_types NOT NULL,
  owner_id INTEGER NOT NULL REFERENCES users (id) ON UPDATE CASCADE,
  tag_id INTEGER REFERENCES tag (id) ON UPDATE CASCADE,
  photo VARCHAR(255)
);

CREATE TABLE eventInvitation (
  id SERIAL PRIMARY KEY,
  sentDate TIMESTAMP NOT NULL CHECK (sentDate <= now()),
  event_id INTEGER NOT NULL REFERENCES events (id) ON UPDATE CASCADE,
  user_invited_id INTEGER NOT NULL REFERENCES users (id) ON UPDATE CASCADE,
  user_host_id INTEGER NOT NULL REFERENCES users (id) ON UPDATE CASCADE,
  decision participation_type
);

CREATE TABLE eventTicket (
  id SERIAL PRIMARY KEY,
  price NUMERIC(4,2) NOT NULL CHECK (price >= 0) DEFAULT 0,
  event_id INTEGER NOT NULL REFERENCES events (id) ON UPDATE CASCADE,
  eventTicketNumber INTEGER /*CHECK (eventTicketNumber > 0 AND eventTicketNumber <= (SELECT capacity FROM events WHERE id = event_id))*/
);

CREATE TABLE comments(
  id SERIAL PRIMARY KEY,
  content VARCHAR(512) NOT NULL,
  owner_id INTEGER NOT NULL REFERENCES users
 (id) ON UPDATE CASCADE,
  event_id INTEGER NOT NULL REFERENCES events (id) ON UPDATE CASCADE,
  dateTime TIMESTAMP NOT NULL CHECK (dateTime<=now())
);

CREATE TABLE attendance (
  user_id INTEGER,
  event_id INTEGER,
  participation participation_type,
  wishlist BOOLEAN NOT NULL DEFAULT FALSE,
  PRIMARY KEY (user_id, event_id),
  FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE,
  FOREIGN KEY (event_id) REFERENCES events(id) ON UPDATE CASCADE
);


/* temos de ver como fica PK quando a notificação é do tipo comment/event porque tem de ter o ID respetivo*/
CREATE TABLE notification (
  id SERIAL PRIMARY KEY,
  dateTime TIMESTAMP NOT NULL CHECK (dateTime<=now()),  
  notified_user INTEGER NOT NULL REFERENCES users
 (id) ON UPDATE CASCADE,
  type notification_type NOT NULL
);


--
-- Insert values.
--


INSERT INTO users (username, name, email, password, userStatus, isAdmin) 
VALUES 
  ('alice_wonderland', 'Alice Wonderland', 'alice@example.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Active', FALSE), -- password 1234
  ('bob_marley', 'Bob Marley', 'bob@example.com', 'bobpass', 'Active', FALSE),
  ('charlie_chaplin', 'Charlie Chaplin', 'charlie@example.com', 'charliepass', 'Active', FALSE),
  ('david_copperfield', 'David Copperfield', 'david@example.com', 'davidpass', 'Active', FALSE),
  ('eve_gardner', 'Eve Gardner', 'eve@example.com', 'evepass', 'Suspended',FALSE),
  ('frank_fisher', 'Frank Fisher', 'frank@example.com', 'frankpass', 'Active', FALSE),
  ('grace_gibson', 'Grace Gibson', 'grace@example.com', 'gracepass', 'Active', FALSE),
  ('hank_harrison', 'Hank Harrison', 'hank@example.com', 'hankpass', 'Active', FALSE),
  ('irene_ingram', 'Irene Ingram', 'irene@example.com', 'irenepass', 'Active', FALSE),
  ('jason_jones', 'Jason Jones', 'jason@example.com', '$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W', 'Active', TRUE);


INSERT INTO tag (name) VALUES 
  ('Music'),
  ('Tech'),
  ('Fitness'),
  ('Education'),
  ('Art'),
  ('Science'),
  ('Food'),
  ('Travel'),
  ('Gaming'),
  ('Fashion');


INSERT INTO events (eventName, startDateTime, endDateTime, registrationEndTime, local, description, capacity, isPublic, status, owner_id, tag_id, photo)
VALUES 
  ('Concert Night', '2023-09-10 19:00:00', '2023-09-10 23:00:00', '2023-09-05 23:59:59', 'Music Hall', 'Live music and entertainment', 100, true, 'Active', 3, 1, 'concertnight.webp'),
  ('Tech Workshop', '2023-10-15 10:00:00', '2023-10-15 16:00:00', '2023-10-10 23:59:59', 'Tech Hub', 'Hands-on coding experience', 50, true, 'Active', 4, 2, 'techworkshop.jpeg'),
  ('Fitness Challenge', '2023-11-05 08:00:00', '2023-11-05 12:00:00', '2023-11-01 23:59:59', 'Fitness Center', 'Join us for a morning workout', 30, true, 'Active', 5, 3, 'fitnesschallenge.webp'),
  ('Science Fair', '2023-12-01 13:00:00', '2023-12-01 17:00:00', '2023-11-25 23:59:59', 'Science Museum', 'Discover the wonders of science', 80, true, 'Active', 6, 6, 'sciencefair.jpeg'),
  ('Art Exhibition', '2024-01-20 11:00:00', '2024-01-20 18:00:00', '2024-01-15 23:59:59', 'Art Gallery', 'Showcasing local artists', 120, true, 'Active', 7, 5, 'artgallery.webp'),
  ('Cooking Class', '2024-02-08 17:30:00', '2024-02-08 20:30:00', '2024-02-01 23:59:59', 'Culinary School', 'Learn to cook delicious dishes', 25, true, 'Active', 8, 7, 'cookingclass.jpeg'),
  ('Travel Talk', '2024-03-12 15:00:00', '2024-03-12 17:00:00', '2024-03-07 23:59:59', 'Community Center', 'Share travel stories and tips', 40, true, 'Active', 9, 8, 'traveltalk.jpeg'),
  ('Gaming Tournament', '2024-04-05 18:00:00', '2024-04-05 22:00:00', '2024-04-01 23:59:59', 'Gaming Arena', 'Compete in various gaming challenges', 60, true, 'Active', 10, 9, 'gamingtournament.webp'),
  ('Fashion Show', '2024-05-22 14:00:00', '2024-05-22 17:00:00', '2024-05-17 23:59:59', 'Fashion Mall', 'Showcasing the latest trends', 75, true, 'Active', 1, 10, 'fashionshow.jpeg'),
  ('Community Cleanup', '2024-06-10 09:00:00', '2024-06-10 12:00:00', '2024-06-05 23:59:59', 'Community Park', 'Join hands for a cleaner community', 50, true, 'Active', 2, 4, 'communitycleanup.jpeg');


INSERT INTO eventInvitation (sentDate, event_id, user_invited_id, user_host_id, decision)
VALUES 
  ('2023-09-01 08:00:00', 3, 4, 3, 'Going'),
  ('2023-10-01 11:30:00', 4, 3, 4, 'Maybe'),
  ('2023-11-01 16:00:00', 5, 6, 5, 'Going'),
  ('2023-08-01 09:30:00', 6, 5, 6, 'Not Going'),
  ('2023-01-01 14:45:00', 7, 8, 7, 'Going'),
  ('2023-02-01 19:20:00', 8, 7, 8, 'Maybe'),
  ('2023-03-01 13:10:00', 9, 10, 9, 'Not Going'),
  ('2023-04-01 17:45:00', 10, 9, 10, 'Going'),
  ('2023-05-01 12:30:00', 1, 2, 1, 'Going'),
  ('2023-06-01 10:15:00', 2, 1, 2, 'Maybe');


INSERT INTO eventTicket (price, event_id, eventTicketNumber) 
VALUES 
  (15.00, 3, 20),
  (25.00, 4, 40),
  (10.00, 5, 15),
  (30.00, 6, 50),
  (12.00, 7, 25),
  (20.00, 8, 30),
  (18.00, 9, 35),
  (22.00, 10, 45),
  (15.00, 1, 20),
  (25.00, 2, 40);


INSERT INTO comments (content, owner_id, event_id, dateTime) 
VALUES 
  ('Can not wait for the concert!', 3, 3, '2023-09-02 14:00:00'),
  ('Tech workshops are always informative!', 4, 4, '2023-10-02 17:30:00'),
  ('Ready to challenge myself!', 5, 5, '2023-11-06 10:00:00'),
  ('Science is fascinating!', 6, 6, '2023-11-02 15:15:00'),
  ('Art speaks louder than words.', 7, 7, '2022-01-21 12:45:00'),
  ('Cooking is an art too!', 8, 8, '2022-02-09 18:00:00'),
  ('Share your travel adventures!', 9, 9, '2021-03-13 16:20:00'),
  ('Gaming enthusiasts, unite!', 10, 10, '2022-04-06 19:30:00'),
  ('Fashion forward!', 1, 1, '2021-05-23 15:30:00'),
  ('Let us make our community better!', 2, 2, '2023-06-05 10:30:00'),
  ('Looking forward to the music festival!', 5, 3, '2023-09-03 18:45:00'),
  ('Great learning experience at the coding bootcamp!', 7, 4, '2023-10-15 14:00:00'),
  ('Exploring new technologies at the tech conference!', 8, 5, '2023-11-10 11:30:00'),
  ('Attending a workshop on space exploration!', 1, 6, '2023-11-05 13:45:00'),
  ('Excited for the upcoming art exhibition!', 2, 7, '2022-02-18 16:20:00'),
  ('Mastering new recipes at the cooking class!', 4, 8, '2022-03-15 19:00:00'),
  ('Capturing beautiful moments during travel!', 6, 9, '2021-04-20 09:45:00'),
  ('Gaming night with friends!', 3, 10, '2022-05-10 20:15:00'),
  ('Showcasing the latest fashion trends!', 10, 1, '2021-06-30 17:00:00'),
  ('Community cleanup initiative – join us!', 6, 2, '2023-07-15 08:30:00');


INSERT INTO attendance (user_id, event_id, participation, wishlist)
VALUES 
  (1, 3, 'Going', false),
  (1, 7, 'Going', false),
  (2, 4, 'Maybe', true),
  (3, 5, 'Going', false),
  (4, 6, 'Not Going', false),
  (5, 7, 'Going', false),
  (6, 8, 'Maybe', false),
  (7, 9, 'Not Going', true),
  (8, 10, 'Going', false),
  (9, 1, 'Going', false),
  (10, 2, 'Maybe', false),
  (1, 10, 'Not Going', true),
  (2, 9, 'Going', false),
  (3, 8, 'Maybe', false),
  (4, 7, 'Going', false),
  (5, 6, 'Not Going', true),
  (6, 5, 'Going', false),
  (7, 4, 'Maybe', false),
  (8, 3, 'Going', false),
  (9, 2, 'Going', false),
  (10, 1, 'Not Going', false);


INSERT INTO notification (dateTime, notified_user, type) 
VALUES 
  ('2023-09-05 08:30:00', 1, 'event_notification'),
  ('2023-10-10 11:45:00', 2, 'comment_notification'),
  ('2023-11-15 14:20:00', 3, 'event_notification'),
  ('2023-10-20 09:00:00', 4, 'comment_notification'),
  ('2022-01-25 12:00:00', 5, 'event_notification'),
  ('2022-02-27 17:30:00', 6, 'comment_notification'),
  ('2022-04-05 14:45:00', 7, 'event_notification'),
  ('2023-05-10 18:20:00', 8, 'comment_notification'),
  ('2021-06-15 11:15:00', 9, 'event_notification'),
  ('2021-07-01 10:00:00', 10, 'comment_notification');