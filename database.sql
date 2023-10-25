BEGIN TRANSACTION;
CREATE TABLE IF NOT EXISTS "User" (
    "userID" SERIAL NOT NULL,
    "username" TEXT NOT NULL,
    "name" TEXT NOT NULL,
    "e-mail" TEXT NOT NULL,
    "password" TEXT NOT NULL,
    "userStatus" TEXT NOT NULL CHECK("userStatus" = 'Active' OR "userStatus" = 'Banned' OR "userStatus" = 'Suspended'),
    PRIMARY KEY ("userID")
);

CREATE TABLE IF NOT EXISTS "Event" (
    "eventID" SERIAL NOT NULL,
    "eventName" TEXT NOT NULL,
    "startDateTime" TIMESTAMP NOT NULL,
    "endDateTime" TIMESTAMP NOT NULL,
    "registrationEndTime" TIMESTAMP NOT NULL,
    "local" TEXT NOT NULL,
    "description" TEXT NOT NULL,
    "capacity" INTEGER NOT NULL,
    "isPublic" BOOLEAN NOT NULL,
    "status" TEXT NOT NULL,
    PRIMARY KEY ("eventID")
);

CREATE TABLE IF NOT EXISTS "EventInvitation" (
    "userInvited" INTEGER NOT NULL,
    "sentDate" TIMESTAMP,
    "inviteResponse" TEXT CHECK("inviteResponse" = 'I''m going' OR "inviteResponse" = 'I''m not going' OR "inviteResponse" = 'I''m thinking'),
    FOREIGN KEY ("userInvited") REFERENCES "User" ("userID")
);

CREATE TABLE IF NOT EXISTS "Tag" (
    "name" TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS "Attendance" (
    "participation" TEXT CHECK("participation" = 'I''m going' OR "participation" = 'I''m not going'),
    "whishlist" BOOLEAN NOT NULL DEFAULT 'False'
);

CREATE TABLE IF NOT EXISTS "Comments" (
    "commentID" SERIAL NOT NULL,
    "content" TEXT NOT NULL,
    "dateTime" TIMESTAMP NOT NULL,
    PRIMARY KEY ("commentID")
);

CREATE TABLE IF NOT EXISTS "Notifications" (
    "notificationID" SERIAL NOT NULL,
    "date" TIMESTAMP NOT NULL,
    "viewed" BOOLEAN NOT NULL DEFAULT 'False',
    PRIMARY KEY ("notificationID")
);

CREATE TABLE IF NOT EXISTS "EventTicket" (
    "ticketID" SERIAL NOT NULL,
    "eventID" INTEGER NOT NULL,
    "price" INTEGER NOT NULL DEFAULT 0,
    "ticketNumber" INTEGER NOT NULL,
    PRIMARY KEY ("ticketID"),
    FOREIGN KEY ("eventID") REFERENCES "Event" ("eventID")
);

CREATE TABLE IF NOT EXISTS "EventNotification" (
    "eventID" INTEGER NOT NULL,
    "content" TEXT NOT NULL,
    PRIMARY KEY ("eventID"),
    FOREIGN KEY ("eventID") REFERENCES "Event" ("eventID")
);

CREATE TABLE IF NOT EXISTS "UserNotification" (
    "userID" INTEGER NOT NULL,
    "content" TEXT NOT NULL,
    PRIMARY KEY ("userID"),
    FOREIGN KEY ("userID") REFERENCES "User" ("userID")
);

CREATE TABLE IF NOT EXISTS "CommentNotification" (
    "commentID" INTEGER NOT NULL,
    "content" TEXT NOT NULL,
    PRIMARY KEY ("commentID"),
    FOREIGN KEY ("commentID") REFERENCES "Comments" ("commentID")
);

COMMIT;
