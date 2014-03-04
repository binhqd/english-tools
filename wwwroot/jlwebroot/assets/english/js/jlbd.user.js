;(function($, scope){
	scope['user'] = {
		collection : {
			items : {},
			add : function(user) {
				this.items[user.id] = user;
			},
			get : function(userID) {
				return this.items[userID] ? this.items[userID] : null; 
			},
			current : {
				user : null
			}
		},
		Libs : {
			JLUser : function(userID, attr) {
				this.id = userID;
				this.attr = attr;
				
				// end
				jlbd.user.collection.add(this);
			}
		}
	}
})(jQuery, jlbd);