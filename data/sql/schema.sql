CREATE TABLE channel (id BIGINT AUTO_INCREMENT, title VARCHAR(255) NOT NULL, subtitle VARCHAR(255) NOT NULL, author VARCHAR(60) NOT NULL, summary TEXT NOT NULL, description TEXT NOT NULL, category VARCHAR(40) NOT NULL, image VARCHAR(255) NOT NULL, link VARCHAR(255) NOT NULL, language VARCHAR(40) NOT NULL, copyright VARCHAR(255) NOT NULL, explicit TINYINT(1) DEFAULT '0' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = INNODB;
CREATE TABLE item (id BIGINT AUTO_INCREMENT, channel_id BIGINT NOT NULL, title VARCHAR(255) NOT NULL, subtitle VARCHAR(255) NOT NULL, author VARCHAR(60) NOT NULL, summary TEXT NOT NULL, image VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, lenght BIGINT NOT NULL, type ENUM('audio/mpeg', 'video/mp4') DEFAULT 'audio/mpeg', pub_date DATETIME NOT NULL, duration VARCHAR(16) NOT NULL, keywords VARCHAR(255) DEFAULT 'muchobeat, mucho beat, music' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, slug VARCHAR(255), UNIQUE INDEX item_sluggable_idx (slug), INDEX channel_id_idx (channel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = INNODB;
CREATE TABLE sf_guard_forgot_password (id BIGINT AUTO_INCREMENT, user_id BIGINT NOT NULL, unique_key VARCHAR(255), expires_at DATETIME NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = INNODB;
CREATE TABLE sf_guard_group (id BIGINT AUTO_INCREMENT, name VARCHAR(255) UNIQUE, description TEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = INNODB;
CREATE TABLE sf_guard_group_permission (group_id BIGINT, permission_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(group_id, permission_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = INNODB;
CREATE TABLE sf_guard_permission (id BIGINT AUTO_INCREMENT, name VARCHAR(255) UNIQUE, description TEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = INNODB;
CREATE TABLE sf_guard_remember_key (id BIGINT AUTO_INCREMENT, user_id BIGINT, remember_key VARCHAR(32), ip_address VARCHAR(50), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = INNODB;
CREATE TABLE sf_guard_user (id BIGINT AUTO_INCREMENT, first_name VARCHAR(255), last_name VARCHAR(255), email_address VARCHAR(255) NOT NULL UNIQUE, username VARCHAR(128) NOT NULL UNIQUE, algorithm VARCHAR(128) DEFAULT 'sha1' NOT NULL, salt VARCHAR(128), password VARCHAR(128), is_active TINYINT(1) DEFAULT '1', is_super_admin TINYINT(1) DEFAULT '0', last_login DATETIME, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX is_active_idx_idx (is_active), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = INNODB;
CREATE TABLE sf_guard_user_group (user_id BIGINT, group_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(user_id, group_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = INNODB;
CREATE TABLE sf_guard_user_permission (user_id BIGINT, permission_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(user_id, permission_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = INNODB;
ALTER TABLE item ADD CONSTRAINT item_channel_id_channel_id FOREIGN KEY (channel_id) REFERENCES channel(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_forgot_password ADD CONSTRAINT sf_guard_forgot_password_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_group_permission ADD CONSTRAINT sf_guard_group_permission_permission_id_sf_guard_permission_id FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_group_permission ADD CONSTRAINT sf_guard_group_permission_group_id_sf_guard_group_id FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_remember_key ADD CONSTRAINT sf_guard_remember_key_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_group ADD CONSTRAINT sf_guard_user_group_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_group ADD CONSTRAINT sf_guard_user_group_group_id_sf_guard_group_id FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_permission ADD CONSTRAINT sf_guard_user_permission_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_permission ADD CONSTRAINT sf_guard_user_permission_permission_id_sf_guard_permission_id FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE;
