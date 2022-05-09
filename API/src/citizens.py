from flask_restful import Resource
from flask import jsonify, request
from loguru import logger
from dotenv import load_dotenv
import hashlib
from loguru import logger
import sys, os

from src.db import ExecuteQuery, ExecuteSelectQuery

# load .env variables
load_dotenv()


class login(Resource):
    def post(self):
        msg = ""
        response = ""
        try:
            content = request.json
            email = content['email']
            email = email.lower()
            password = content['password']
            encrypted_password = hashlib.md5(password.encode())
            password = encrypted_password.hexdigest()
            
            user_id = ""
            user_type = ""

            if email == "" or password == "" or not email or not password:
                msg = "failed"
                response = "Empty email or password!"
            else:
                select_response = ExecuteSelectQuery.execute("SELECT id, user_type FROM users WHERE email='"+email+"' AND user_password='"+password+"' LIMIT 1;")
                
                if(len(select_response) > 0):
                    user_id = select_response[0][0]
                    user_type = select_response[0][1]
                    msg = "success"
                    response = "User found!"
                else:
                    msg = "failed"
                    response = "User not found!"

            logger.info("Response | login: "+response)
            return '{"msg":"'+msg+'", "response":"'+response+'", "user_id":"'+str(user_id)+'", "user_type":"'+str(user_type)+'"}'
        except Exception as e:
            msg = "failed"
            response = str(e)
            logger.error("Exception | register: "+response)
            return '{"msg":"'+msg+'", "response":"'+response+'"}'


class register(Resource):
    def post(self):
        
        msg = ""
        response = ""

        try:
            content = request.json

            fname = content['fname']
            lname = content['lname']
            email = content['email']
            email = email.lower()
            user_type = content['user_type']
            user_password = content['user_password']
            encrypted_password = hashlib.md5(user_password.encode())
            user_password = encrypted_password.hexdigest()
            
            user_id = ""

            if email == "" or user_password == "" or not email or not user_password:
                msg = "failed"
                response = "Empty email or password!"
            else:
                insert_query = "INSERT IGNORE INTO users (fname, lname, email, user_type, user_password) VALUES ('"+fname+"', '"+lname+"', '"+email+"', "+user_type+", '"+user_password+"');"
                query_response = ExecuteQuery.execute(insert_query)

                if(query_response == "success"):
                    select_response = ExecuteSelectQuery.execute("SELECT id FROM users WHERE email='"+email+"' AND user_password='"+user_password+"' LIMIT 1;")
                    
                    if(len(select_response) > 0):
                        user_id = str(select_response[0][0])
                        msg = "success"
                        response = "User found!"
                        insert_query = "INSERT IGNORE INTO citizen_details (user_id) VALUES ("+user_id+");"
                        query_response = ExecuteQuery.execute(insert_query)
                    else:
                        msg = "failed"
                        response = "User not found!"
                else:
                    msg = "failed"
                    response = "User insert failed!"

                response = query_response

            logger.info("Response | register: "+response)
            return '{"msg":"'+msg+'", "response":"'+response+'", "user_id":"'+str(user_id)+'", "user_type":"'+str(user_type)+'"}'
        except Exception as e:
            msg = "failed"
            response = str(e)
            exc_type, exc_obj, exc_tb = sys.exc_info()
            logger.error("Exception | register: "+response+"\nLine: "+str(exc_tb.tb_lineno))
            return '{"msg":'+msg+', "response":'+response+'}'
            

class get_user_1(Resource):
    def get(self, user_id):
        msg = ""
        response = ""
        fname = ""
        lname = ""
        email = ""
        reg_date = ""
        c1_id = ""
        c1_time = ""
        c1_msg = ""
        c2_id = ""
        c2_time = ""
        c2_msg = ""
        c3_id = ""
        c3_time = ""
        c3_msg = ""


        try:
            select_response = ExecuteSelectQuery.execute("SELECT fname, lname, email, reg_date FROM users WHERE id='"+user_id+"' LIMIT 1;")
            
            if(len(select_response) > 0):
                fname = select_response[0][0]
                lname = select_response[0][1]
                email = select_response[0][2]
                reg_date = select_response[0][3]

                select_response1 = ExecuteSelectQuery.execute("SELECT complaint_id, message, curent_timestamp FROM complaint_msgs WHERE user_id='"+user_id+"' GROUP BY complaint_id LIMIT 3;")
            
                if(len(select_response) > 0):
                    try:
                        c1_id = select_response1[0][0]
                        c1_msg = select_response1[0][1]
                        c1_time = select_response1[0][2]
                        c2_id = select_response1[1][0]
                        c2_msg = select_response1[1][1]
                        c2_time = select_response1[1][2]
                        c3_id = select_response1[2][0]
                        c3_msg = select_response1[2][1]
                        c3_time = select_response1[2][2]
                    except:
                        pass
                msg = "success"
                response = "User found!"
            else:
                msg = "failed"
                response = "User not found!"

            logger.info("Response | get_user_1: "+response)
            returnVal = '{"msg":"'+msg+'", "response":"'+response+'", "fname":"'+str(fname)+'", "lname":"'+str(lname)+'", "email":"'+str(email)+'", "reg_date":"'+str(reg_date)+'", "c1_id":"'+str(c1_id)+'", "c1_msg":"'+str(c1_msg)+'", "c1_time":"'+str(c1_time)+'", "c2_id":"'+str(c2_id)+'", "c2_msg":"'+str(c2_msg)+'", "c2_time":"'+str(c2_time)+'", "c3_id":"'+str(c3_id)+'", "c3_msg":"'+str(c3_msg)+'", "c3_time":"'+str(c3_time)+'"}'

            return returnVal
        except Exception as e:
            msg = "failed"
            response = str(e)
            exc_type, exc_obj, exc_tb = sys.exc_info()
            logger.error("Exception | get_user_1: "+response+"\nLine: "+str(exc_tb.tb_lineno))
            return '{"msg":"'+msg+'", "response":"'+response+'"}'


class get_user_2(Resource):
    def get(self, user_id):
        msg = ""
        response = ""
        dob = ""
        nic = ""
        mobile = ""
        address_home = ""
        address_city = ""
        address_postal_code = ""
        address_country = ""
        industry = ""
        current_job_title = ""
        highest_education = ""
        expected_salary = ""
        profile_status = ""
        about = ""
        skill1 = ""
        skill2 = ""
        skill3 = ""


        try:
            select_response = ExecuteSelectQuery.execute("SELECT dob, nic, mobile, address_home, address_city, address_postal_code, address_country, industry, current_job_title, highest_education, expected_salary, profile_status, about, user_skill1, user_skill2, user_skill3 FROM citizen_details WHERE user_id="+user_id+" LIMIT 1;")
        
            if(len(select_response) > 0):
                dob = select_response[0][0]
                nic = select_response[0][1]
                mobile = select_response[0][2]
                address_home = select_response[0][3]
                address_city = select_response[0][4]
                address_postal_code = select_response[0][5]
                address_country = select_response[0][6]
                industry = select_response[0][7]
                current_job_title = select_response[0][8]
                highest_education = select_response[0][9]
                expected_salary = select_response[0][10]
                profile_status = select_response[0][11]
                about = select_response[0][12]
                skill1 = select_response[0][13]
                skill2 = select_response[0][14]
                skill3 = select_response[0][15]

                msg = "success"
                response = "User found!"
            else:
                msg = "failed"
                response = "User not found!"

            logger.info("Response | get_user_2: "+response)
            returnVal = '{"msg":"'+msg+'", "response":"'+response+'", "dob":"'+str(dob)+'", "nic":"'+str(nic)+'", "mobile":"'+str(mobile)+'", "address_home":"'+str(address_home)+'", "address_city":"'+str(address_city)+'", "address_postal_code":"'+str(address_postal_code)+'", "address_country":"'+str(address_country)+'", "industry":"'+str(industry)+'", "current_job_title":"'+str(current_job_title)+'", "highest_education":"'+str(highest_education)+'", "expected_salary":"'+str(expected_salary)+'", "profile_status":"'+str(profile_status)+'", "about":"'+str(about)+'", "skill1":"'+str(skill1)+'", "skill2":"'+str(skill2)+'", "skill3":"'+str(skill3)+'"}'

            return returnVal
        except Exception as e:
            msg = "failed"
            response = str(e)
            exc_type, exc_obj, exc_tb = sys.exc_info()
            logger.error("Exception | get_user: "+response+"\nLine: "+str(exc_tb.tb_lineno))
            return '{"msg":"'+msg+'", "response":"'+response+'"}'


class update_profile(Resource):
    def put(self, user_id):
        msg = ""
        response = ""
        
        try:
            content = request.json
            user_designation = content['user_designation']
            user_mobile = content['user_mobile']
            user_industry = content['user_industry']
            user_highest_education = content['user_highest_education']
            user_expected_salary = content['user_expected_salary']
            user_address = content['user_address']
            user_nic = content['user_nic']
            user_dob = content['user_dob']
            user_country = content['user_country']
            user_postcode = content['user_postcode']
            user_city = content['user_city']
            user_about = content['user_about']
            user_skill1 = content['user_skill1']
            user_skill2 = content['user_skill2']
            user_skill3 = content['user_skill3']

            query_response = ExecuteQuery.execute("UPDATE citizen_details SET about='"+str(user_about)+"', dob='"+str(user_dob)+"', nic='"+str(user_nic)+"', mobile='"+str(user_mobile)+"', address_home='"+str(user_address)+"', address_city='"+str(user_city)+"', address_postal_code='"+str(user_postcode)+"', address_country='"+str(user_country)+"', industry='"+str(user_industry)+"', current_job_title='"+str(user_designation)+"', highest_education='"+str(user_highest_education)+"', expected_salary='"+str(user_expected_salary)+"', user_skill1='"+str(user_skill1)+"', user_skill2='"+str(user_skill2)+"', user_skill3='"+str(user_skill3)+"', profile_status=0 WHERE user_id="+user_id+";")
            
            if(query_response == "success"):
                msg = "success"
                logger.debug("Response | update_query: "+query_response)
            else:
                msg = "failed"
                logger.error("Response | update_query: "+query_response)
            

            logger.info("Response | get_user_1: "+response)
            return '{"msg":"'+msg+'", "response":"'+response+'"}'

        except Exception as e:
            msg = "failed"
            response = str(e)
            exc_type, exc_obj, exc_tb = sys.exc_info()
            logger.error("Exception | update_profile: "+response+"\nLine: "+str(exc_tb.tb_lineno))
            return '{"msg":"'+msg+'", "response":"'+response+'"}'


class get_users(Resource):
    def get(self):
        try:
            select_response = ExecuteSelectQuery.execute("SELECT users.fname, users.lname, users.email, users.reg_date, citizen_details.industry, citizen_details.current_job_title, citizen_details.profile_status, users.id FROM users LEFT JOIN citizen_details ON users.id=citizen_details.user_id WHERE users.user_type=1;")

            users = ""

            if(len(select_response) > 0):
                for row in select_response:
                    users += str(row[0])+","+str(row[1])+","+str(row[2])+","+str(row[3].strftime('%Y/%m/%d'))+","+str(row[4])+","+str(row[5])+","+str(row[6])+","+str(row[7])+"|"
                msg = "success"
                response = "User found!"
            else:
                msg = "success"
                response = "Users not found!"

            logger.debug(str(users))

            logger.info("Response | get_users: "+response)
            return '{"msg":"'+msg+'", "response":"'+response+'", "users": "'+str(users)+'"}'
        except Exception as e:
            msg = "failed"
            response = str(e)
            exc_type, exc_obj, exc_tb = sys.exc_info()
            logger.error("Exception | get_user: "+response+"\nLine: "+str(exc_tb.tb_lineno))
            return '{"msg":"'+msg+'", "response":"'+response+'"}'


class approval(Resource):
    def put(self, user_id):
        msg = ""
        response = ""
        
        try:
            query_response = ExecuteQuery.execute("UPDATE citizen_details SET profile_status=1 WHERE user_id="+user_id+";")
            
            if(query_response == "success"):
                msg = "success"
                logger.debug("Response | approval_put: "+query_response)
            else:
                msg = "failed"
                logger.error("Response | approval_put: "+query_response)
            

            logger.info("Response | approval_put: "+response)
            return '{"msg":"'+msg+'", "response":"'+response+'"}'

        except Exception as e:
            msg = "failed"
            response = str(e)
            exc_type, exc_obj, exc_tb = sys.exc_info()
            logger.error("Exception | approval_put: "+response+"\nLine: "+str(exc_tb.tb_lineno))
            return '{"msg":"'+msg+'", "response":"'+response+'"}'


    def delete(self, user_id):
        msg = ""
        response = ""
        
        try:
            query_response = ExecuteQuery.execute("UPDATE citizen_details SET profile_status=0 WHERE user_id="+user_id+";")

            if(query_response == "success"):
                msg = "success"
                logger.debug("Response | approval_delete: "+query_response)
            else:
                msg = "failed"
                logger.error("Response | approval_delete: "+query_response)
            

            logger.info("Response | approval_delete: "+response)
            return '{"msg":"'+msg+'", "response":"'+response+'"}'

        except Exception as e:
            msg = "failed"
            response = str(e)
            exc_type, exc_obj, exc_tb = sys.exc_info()
            logger.error("Exception | approval_delete: "+response+"\nLine: "+str(exc_tb.tb_lineno))
            return '{"msg":"'+msg+'", "response":"'+response+'"}'

