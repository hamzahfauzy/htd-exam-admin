INSERT INTO roles (name) VALUES ('Super Admin'),('Guru'),('Peserta');

INSERT INTO role_routes (role_id, route_path) VALUES 
((SELECT id FROM roles WHERE `name` = 'Super Admin'), '*'),
((SELECT id FROM roles WHERE `name` = 'Guru'), 'dashboard'),
((SELECT id FROM roles WHERE `name` = 'Guru'), 'crud/index?table=exam_questions'),
((SELECT id FROM roles WHERE `name` = 'Guru'), 'default/*'),
((SELECT id FROM roles WHERE `name` = 'Guru'), 'crud/create?table=exam_questions'),
((SELECT id FROM roles WHERE `name` = 'Guru'), 'crud/edit?table=exam_questions'),
((SELECT id FROM roles WHERE `name` = 'Guru'), 'crud/delete?table=exam_questions'),
((SELECT id FROM roles WHERE `name` = 'Guru'), 'crud/index?table=exam_question_items'),
((SELECT id FROM roles WHERE `name` = 'Guru'), 'crud/edit?table=exam_question_items'),
((SELECT id FROM roles WHERE `name` = 'Guru'), 'crud/delete?table=exam_question_items'),
((SELECT id FROM roles WHERE `name` = 'Guru'), 'crud/create?table=exam_question_items'),
((SELECT id FROM roles WHERE `name` = 'Guru'), 'crud/index?table=exam_question_answers'),
((SELECT id FROM roles WHERE `name` = 'Guru'), 'crud/create?table=exam_question_answers'),
((SELECT id FROM roles WHERE `name` = 'Guru'), 'crud/edit?table=exam_question_answers'),
((SELECT id FROM roles WHERE `name` = 'Guru'), 'crud/delete?table=exam_question_answers'),
((SELECT id FROM roles WHERE `name` = 'Guru'), 'exam/questions/items/import'),
((SELECT id FROM roles WHERE `name` = 'Peserta'), 'dashboard'),
((SELECT id FROM roles WHERE `name` = 'Peserta'), 'crud/index?table=exam_schedules'),
((SELECT id FROM roles WHERE `name` = 'Peserta'), 'exam/do'),
((SELECT id FROM roles WHERE `name` = 'Peserta'), 'exam/result');