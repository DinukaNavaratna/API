from flask_restful import Resource
import mysql.connector
import os
from loguru import logger
from flask import request

def init():
    try:
        conn = mysql.connector.connect(
            host = os.getenv('db_host'),
            port = os.getenv('db_port'),
            user = os.getenv('db_user'),
            password = os.getenv('db_password'),
            database = os.getenv('db_database')
        )
        return conn
    except Exception as ex:
        logger.error("Exception | init: "+str(ex))
        return "failed"


class create_db(Resource):
    def get(self):
        try:
            conn = init()
            if conn != "failed":
                cur = conn.cursor()
                cur.execute("CREATE TABLE IF NOT EXISTS users (id INT AUTO_INCREMENT PRIMARY KEY, fname VARCHAR(255), lname VARCHAR(255), email VARCHAR(255) UNIQUE, user_type INT, user_password VARCHAR(255), reg_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP);")
                cur.execute("CREATE TABLE IF NOT EXISTS user_types (id INT AUTO_INCREMENT PRIMARY KEY, user_type VARCHAR(25) UNIQUE);")
                cur.execute("CREATE TABLE IF NOT EXISTS citizen_details (user_id INT PRIMARY KEY, about VARCHAR(255), dob VARCHAR(10), nic VARCHAR(20), mobile VARCHAR(15), address_home VARCHAR(255), address_city VARCHAR(100), address_postal_code VARCHAR(10), address_country VARCHAR(50), industry VARCHAR(255), current_job_title VARCHAR(100), highest_education VARCHAR(255), expected_salary VARCHAR(20), profile_status INT, user_skill1 VARCHAR(255), user_skill2 VARCHAR(255), user_skill3 VARCHAR(255));")
                cur.execute("CREATE TABLE IF NOT EXISTS complaints (id INT AUTO_INCREMENT PRIMARY KEY, user_id INT, complaint_subject VARCHAR(50), curent_timestamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP);")
                cur.execute("CREATE TABLE IF NOT EXISTS complaint_msgs (id INT AUTO_INCREMENT PRIMARY KEY, complaint_id INT, user_id INT, message VARCHAR(255), curent_timestamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP);")
                cur.execute("INSERT IGNORE INTO user_types (user_type) VALUES ('Citizen'), ('Bureau Officer'), ('Foreign Company');")
                cur.execute("INSERT IGNORE INTO users (fname, lname, email, user_password, user_type) VALUES ('Officer1', 'Lname1', 'officer1@gmail.com', '202cb962ac59075b964b07152d234b70', 2), ('Employee1', 'Company', 'staff1@gmail.com', '202cb962ac59075b964b07152d234b70', 3), ('User1', 'Last', 'user1@gmail.com', '202cb962ac59075b964b07152d234b70', 1);")
                conn.commit()
                cur.close()
                conn.close()
                return "DB Created Successfully!"
            else:
                logger.error("DB Connection Failed!")
                return "Error | DB Connection Failed!"
        except Exception as ex:
            logger.error("Exception | create_db: "+str(ex))
            return "Error | Exception: "+str(ex)


class clear_db(Resource):
    def get(self):
        try:
            conn = init()
            if conn != "failed":
                cur = conn.cursor()
                cur.execute("DROP TABLE IF EXISTS users;")
                cur.execute("DROP TABLE IF EXISTS user_types;")
                cur.execute("DROP TABLE IF EXISTS citizen_details;")
                cur.execute("DROP TABLE IF EXISTS citizen_skills;")
                cur.execute("DROP TABLE IF EXISTS skills;")
                cur.execute("DROP TABLE IF EXISTS complaints;")
                cur.execute("DROP TABLE IF EXISTS complaint_msgs;")
                conn.commit()
                cur.close()
                conn.close()
                return "DB Cleared Successfully!"
            else:
                logger.error("DB Connection Failed!")
                return "Error | DB Connection Failed!"
        except Exception as ex:
            logger.error("Exception | clear_db: "+str(ex))
            return "Error | Exception: "+str(ex)


class ExecuteQuery():
    def execute(query):
        try:
            conn = init()
            if conn != "failed":
                cur = conn.cursor()
                cur.execute(query)
                conn.commit()
                cur.close()
                conn.close()
                return "success"
            else:
                logger.error("DB Connection Failed!")
                return "Error | DB Connection Failed!"
        except Exception as ex:
            logger.error("Exception | ExecuteQuery: "+str(ex))
            return "Error | Exception: "+str(ex)


class ExecuteSelectQuery():
    def execute(query):
        try:
            conn = init()
            if conn != "failed":
                cur = conn.cursor()
                cur.execute(query)
                select = cur.fetchall()
                cur.close()
                conn.close()
                return select
            else:
                logger.error("DB Connection Failed!")
                return "Error | DB Connection Failed!"
        except Exception as ex:
            logger.error("Exception | ExecuteSelectQuery: "+str(ex))
            return "Error | Exception: "+str(ex)


class GetAllFromDB(Resource):
    def get(self):
        table = request.args.get('table')
        try:
            conn = init()
            if conn != "failed":
                cur = conn.cursor()
                cur.execute("SELECT * FROM "+str(table)+";")
                all = cur.fetchall()
                conn.close()
                cur.close()
                return str(all)
            else:
                logger.error("DB Connection Failed!")
                return "DB Connection Failed!"
        except Exception as ex:
            logger.error("Exception | GetAllFromDB: "+str(ex))
            return "Error | Exception: "+str(ex)
