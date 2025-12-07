CREATE TABLE calendar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    start_at DATETIME DEFAULT NULL,
    end_at DATETIME DEFAULT NULL,
    record_type VARCHAR(255) NOT NULL,
    visibility VARCHAR(255) DEFAULT "PRIVATE",
    relation_to VARCHAR(255) DEFAULT NULL,
    relation_id VARCHAR(255) DEFAULT NULL,
    created_by INT(11) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_calendars_created_by FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE CASCADE
);