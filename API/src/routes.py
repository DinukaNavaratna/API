from .db import create_db, clear_db, GetAllFromDB
from .citizens import login, register, get_user_1, get_user_2, update_profile, get_users, approval
from .complaints import complaints

def initialize_routes(api):
    api.add_resource(create_db, "/create_db")
    api.add_resource(clear_db, "/clear_db")
    api.add_resource(login, "/login")
    api.add_resource(register, "/register")
    api.add_resource(GetAllFromDB, "/GetAllFromDB")
    api.add_resource(get_user_1, "/get_user_1/<user_id>")
    api.add_resource(get_user_2, "/get_user_2/<user_id>")
    api.add_resource(update_profile, "/update/<user_id>")
    api.add_resource(get_users, "/get_users")
    api.add_resource(approval, "/approval/<user_id>")
    api.add_resource(complaints, "/complaints")