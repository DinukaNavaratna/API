from flask import Flask, request, jsonify
from flask_restful import Api
from flask_cors import CORS
from dotenv import load_dotenv
import os
from loguru import logger

from src.routes import initialize_routes

# load .env variables
load_dotenv()

# init server
app = Flask(__name__, template_folder = 'reports')
CORS(app, resources={r"/*": {"origins": "*"}})
api = Api(app)

# init api routes
initialize_routes(api)


# connection test route
@app.route("/", methods=["GET", "POST"])
def health():
    return "Hello"


# run Server
if __name__ == "__main__":
    app.run(
        host = os.getenv("app_host"), 
        port = os.getenv("app_port"), 
        debug = os.getenv("app_debug")
    )