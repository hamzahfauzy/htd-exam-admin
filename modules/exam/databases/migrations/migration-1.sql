CREATE TABLE exam_groups (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

CREATE TABLE exam_group_member (
    id INT AUTO_INCREMENT PRIMARY KEY,
    group_id INT NOT NULL,
    user_id INT NOT NULL,
    CONSTRAINT fk_exam_group_member_group_id FOREIGN KEY (group_id) REFERENCES exam_groups(id) ON DELETE CASCADE,
    CONSTRAINT fk_exam_group_member_user_id FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE exam_questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    created_by INT NOT NULL,
    CONSTRAINT fk_exam_questions_created_by FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE exam_question_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question_id INT NOT NULL,
    description LONGTEXT NOT NULL
);

CREATE TABLE exam_question_answers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    item_id INT NOT NULL,
    description LONGTEXT NOT NULL,
    score INT DEFAULT 0,
    CONSTRAINT fk_exam_question_answerd_item_id FOREIGN KEY (item_id) REFERENCES exam_question_items(id) ON DELETE CASCADE
);

CREATE TABLE exam_schedules (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    start_at DATETIME DEFAULT NULL,
    end_at DATETIME DEFAULT NULL,
    status VARCHAR(20) DEFAULT "PUBLISH", -- PUBLISH, DRAFT
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT NULL
);

CREATE TABLE exam_schedule_questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    schedule_id INT NOT NULL,
    question_id INT NOT NULL,
    CONSTRAINT fk_exam_schedule_questions_schedule_id FOREIGN KEY (schedule_id) REFERENCES exam_schedules(id) ON DELETE CASCADE,
    CONSTRAINT fk_exam_schedule_questions_question_id FOREIGN KEY (question_id) REFERENCES exam_questions(id) ON DELETE CASCADE
);

CREATE TABLE exam_schedule_groups (
    id INT AUTO_INCREMENT PRIMARY KEY,
    schedule_id INT NOT NULL,
    group_id INT NOT NULL,
    CONSTRAINT fk_exam_schedule_groups_schedule_id FOREIGN KEY (schedule_id) REFERENCES exam_schedules(id) ON DELETE CASCADE,
    CONSTRAINT fk_exam_schedule_groups_group_id FOREIGN KEY (group_id) REFERENCES exam_groups(id) ON DELETE CASCADE
);

CREATE TABLE exam_member_answers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    schedule_id INT NOT NULL,
    question_item_id INT NOT NULL,
    answer_id INT DEFAULT NULL,
    score VARCHAR(10) DEFAULT "0",
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_exam_member_answers_user_id FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    CONSTRAINT fk_exam_member_answers_schedule_id FOREIGN KEY (schedule_id) REFERENCES exam_schedules(id) ON DELETE CASCADE,
    CONSTRAINT fk_exam_member_answers_question_item_id FOREIGN KEY (question_item_id) REFERENCES exam_question_items(id) ON DELETE CASCADE
);