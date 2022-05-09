from flask_restful import Resource
from flask import jsonify, request
from loguru import logger
from dotenv import load_dotenv
from loguru import logger
import sys, os

from src.db import ExecuteQuery, ExecuteSelectQuery

# load .env variables
load_dotenv()


class complaints(Resource):
    def put(self):
        msg = ""
        response = ""
        try:
            content = request.json
            complaintid = content['complaintid']
            userid = content['userid']
            msg = content['msg']

            if(complaintid == "0"):
                insert_query = "INSERT IGNORE INTO complaints (user_id, complaint_subject) VALUES ("+str(userid)+", '"+msg+"');"
                query_response = ExecuteQuery.execute(insert_query)
            
            select_response = ExecuteSelectQuery.execute("SELECT id FROM complaints ORDER BY id DESC LIMIT 1;") 
            if(len(select_response) > 0):
                complaintid = select_response[0][0]
            else:
                return '{"msg":"failed", "response":"complaint id not found"}'

            insert_query = "INSERT IGNORE INTO complaint_msgs (complaint_id, user_id, message) VALUES ("+str(complaintid)+", "+str(userid)+", '"+msg+"');"
            query_response = ExecuteQuery.execute(insert_query)

            if(query_response == "success"):
                msg = "success"
                response = "Message recorded"
            else:
                msg = "failed"
                response = "Complaint couldn't be recorded!"

            logger.info("Response | complaints_put: "+response)
            return '{"msg":"'+msg+'", "response":"'+response+'"}'
        except Exception as e:
            msg = "failed"
            response = str(e)
            logger.error("Exception | complaints_put: "+response)
            return '{"msg":"'+msg+'", "response":"'+response+'"}'


    def get(self):
        try:
            content = request.json
            complaintid = content['complaintid']
            
            select_response = ExecuteSelectQuery.execute("SELECT user_id, message FROM complaint_msgs WHERE complaint_id="+str(complaintid)+";")

            msgs = ""

            if(len(select_response) > 0):
                for row in select_response:
                    msgs += str(row[0])+","+str(row[1])+"|"
                msg = "success"
                response = "Complaint found!"
            else:
                msg = "success"
                response = "Complaint not found!"

            logger.debug(str(msgs))

            logger.info("Response | complaints_get: "+response)
            return '{"msg":"'+msg+'", "response":"'+response+'", "msgs": "'+str(msgs)+'"}'
        except Exception as e:
            msg = "failed"
            response = str(e)
            exc_type, exc_obj, exc_tb = sys.exc_info()
            logger.error("Exception | complaints_get: "+response+"\nLine: "+str(exc_tb.tb_lineno))
            return '{"msg":"'+msg+'", "response":"'+response+'"}'

