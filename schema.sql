CREATE DATABASE IF NOT EXISTS gestation;
USE gestation;

CREATE TABLE IF NOT EXISTS mother (
  mother_id INT AUTO_INCREMENT PRIMARY KEY,
  mother_name VARCHAR(120) NOT NULL,
  mother_address TEXT,
  mother_etnis TINYINT DEFAULT 0,
  mother_parity TINYINT DEFAULT 0,
  mother_weight FLOAT DEFAULT 0,
  mother_height FLOAT DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS embrio (
  embrio_id INT AUTO_INCREMENT PRIMARY KEY,
  embrio_mother_id INT NOT NULL,
  embrio_edd DATE DEFAULT NULL,
  embrio_sex TINYINT DEFAULT -1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_embrio_mother (embrio_mother_id),
  CONSTRAINT fk_embrio_mother FOREIGN KEY (embrio_mother_id) REFERENCES mother(mother_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS measurement (
  measurement_id INT AUTO_INCREMENT PRIMARY KEY,
  measurement_embrio_id INT NOT NULL,
  measurement_date DATE NOT NULL,
  measurement_height FLOAT DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_measurement_embrio (measurement_embrio_id),
  CONSTRAINT fk_measurement_embrio FOREIGN KEY (measurement_embrio_id) REFERENCES embrio(embrio_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
