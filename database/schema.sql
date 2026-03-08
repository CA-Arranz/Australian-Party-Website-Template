
-- campaign-control-platform SQL Schema

-- Users table: stores admin and staff user accounts
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL, -- Unique username for login
    password_hash VARCHAR(255) NOT NULL, -- Hashed password
    email VARCHAR(100) UNIQUE NOT NULL, -- Unique email address
    role ENUM('admin','staff') NOT NULL, -- User role
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP -- Account creation timestamp
);

-- Volunteers table: records volunteer signups and details
CREATE TABLE volunteers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL, -- Volunteer name
    email VARCHAR(100) NOT NULL, -- Volunteer email
    phone VARCHAR(20), -- Volunteer phone number
    postcode VARCHAR(10), -- Volunteer postcode
    skills TEXT, -- Volunteer skills
    availability TEXT, -- Volunteer availability
    assigned_role VARCHAR(50), -- Assigned campaign role
    registered_at DATETIME DEFAULT CURRENT_TIMESTAMP -- Registration timestamp
);

-- Donations table: tracks campaign donations
CREATE TABLE donations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    donor_name VARCHAR(100) NOT NULL, -- Donor name
    amount DECIMAL(10,2) NOT NULL, -- Donation amount
    date DATETIME DEFAULT CURRENT_TIMESTAMP, -- Donation date
    payment_method VARCHAR(50), -- Payment method
    public_disclosure BOOLEAN DEFAULT 0 -- Public disclosure flag
);

-- Candidates table: stores candidate profiles
CREATE TABLE candidates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL, -- Candidate name
    photo VARCHAR(255), -- Candidate photo URL
    electorate VARCHAR(100) NOT NULL, -- Electorate name
    biography TEXT, -- Candidate biography
    social_links TEXT, -- Candidate social links
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP -- Profile creation timestamp
);

-- Policies table: holds published campaign policies
CREATE TABLE policies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL, -- Policy title
    category VARCHAR(50) NOT NULL, -- Policy category
    content TEXT NOT NULL, -- Policy content
    published_at DATETIME DEFAULT CURRENT_TIMESTAMP -- Publication timestamp
);

-- Events table: stores campaign events
CREATE TABLE events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL, -- Event title
    description TEXT, -- Event description
    date DATETIME NOT NULL, -- Event date
    location VARCHAR(255), -- Event location
    map_link VARCHAR(255), -- Map link for event
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP -- Event creation timestamp
);

-- Event RSVPs table: records RSVPs for events
CREATE TABLE event_rsvps (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_id INT NOT NULL, -- Related event ID
    name VARCHAR(100) NOT NULL, -- RSVP name
    email VARCHAR(100) NOT NULL, -- RSVP email
    phone VARCHAR(20), -- RSVP phone
    attended BOOLEAN DEFAULT 0, -- Attendance flag
    FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE -- Cascade delete on event removal
);

-- News Posts table: stores news and media releases
CREATE TABLE news_posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL, -- News post title
    content TEXT NOT NULL, -- News post content
    published_at DATETIME DEFAULT CURRENT_TIMESTAMP -- Publication timestamp
);

-- Contact Messages table: records contact form submissions
CREATE TABLE contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL, -- Sender name
    email VARCHAR(100) NOT NULL, -- Sender email
    message TEXT NOT NULL, -- Message content
    submitted_at DATETIME DEFAULT CURRENT_TIMESTAMP -- Submission timestamp
);

-- Voters table: stores voter information for outreach
CREATE TABLE voters (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL, -- Voter name
    postcode VARCHAR(10), -- Voter postcode
    electorate VARCHAR(100), -- Voter electorate
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP -- Record creation timestamp
);

-- Outreach Logs table: tracks outreach interactions with voters
CREATE TABLE outreach_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    voter_id INT NOT NULL, -- Related voter ID
    contact_history TEXT, -- Contact history log
    issues_raised TEXT, -- Issues raised by voter
    support_level ENUM('strong','medium','weak','none'), -- Support level
    logged_at DATETIME DEFAULT CURRENT_TIMESTAMP, -- Log timestamp
    FOREIGN KEY (voter_id) REFERENCES voters(id) ON DELETE CASCADE -- Cascade delete on voter removal
);

-- Email Lists table: stores email list groups
CREATE TABLE email_lists (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL, -- List name
    description TEXT, -- List description
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP -- List creation timestamp
);

-- Email Campaigns table: tracks email campaigns sent to lists
CREATE TABLE email_campaigns (
    id INT AUTO_INCREMENT PRIMARY KEY,
    list_id INT NOT NULL, -- Related email list ID
    subject VARCHAR(150) NOT NULL, -- Email subject
    content TEXT NOT NULL, -- Email content
    sent_at DATETIME DEFAULT CURRENT_TIMESTAMP, -- Sent timestamp
    FOREIGN KEY (list_id) REFERENCES email_lists(id) ON DELETE CASCADE -- Cascade delete on list removal
);

-- Audit Logs table: records user actions for compliance and security
CREATE TABLE audit_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT, -- Related user ID
    action VARCHAR(255) NOT NULL, -- Action description
    ip_address VARCHAR(45), -- IP address of user
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP, -- Action timestamp
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL -- Set user_id to NULL on user removal
);
