CREATE TABLE exam_schedule_user_data (
    id INT AUTO_INCREMENT PRIMARY KEY,
    schedule_id INT NOT NULL,
    user_id INT NOT NULL,
    data JSON NOT NULL,
    CONSTRAINT fk_exam_schedule_user_data_schedule_id FOREIGN KEY (schedule_id) REFERENCES exam_schedules(id) ON DELETE CASCADE,
    CONSTRAINT fk_exam_schedule_user_data_user_id FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);