
  /*
    Defines the state being monitored for the module.
  */
	const state = {
		posts: [],
    	post: {},

		postLiked: false,
		postLikeActionStatus: 0,
		postUnlikeActionStatus: 0,

		postsLoadStatus: 0,
		postLoadStatus: 0,
	}

  /*
    Defines the actions used to retrieve the data.
  */
	const actions = {

		loadPosts( { commit } ){
			commit( 'setPostsLoadStatus', 1 );
		    axios.get('/posts')
		        .then( function( response ){
		          commit( 'setPosts', response.data.data );
		          commit( 'setPostsLoadStatus', 2 );
		        })
		        .catch( function(){
		          commit( 'setPosts', [] );
		          commit( 'setPostsLoadStatus', 3 );
			});
    	},

	    loadPost( { commit }, data ){
			commit( 'setPostLikedStatus', false );
			commit( 'setPostLoadStatus', 1 );

	      	axios.get('/posts/' + data.id)
	        .then( function( response ){
	          commit( 'setPost', response.data.data );
						if( response.data.data.user_like_count > 0 ){
							commit('setPostLikedStatus', true);
						}
				commit( 'setPostLoadStatus', 2 );
	        })
	        .catch( function(){
	          commit( 'setPost', {} );
	          commit( 'setPostLoadStatus', 3 );
	        });
	    },


		/*
			Likes a post
		*/
		likePost( { commit, state, dispatch }, data ){
			commit( 'setPostLikeActionStatus', 1 );

			axios.post('/like/post/' + data.id)
				.then( function( response ){
					commit( 'setPostLikedStatus', true );
					commit( 'setPostLikeActionStatus', 2 );

					/*
						Reload the post and update the liked status.
					*/
					dispatch( 'loadPost', { id: data.id } );

					commit( 'updatePostLikedStatus', { id: data.id, count: 1 });
				})
				.catch( function(){
					commit( 'setPostLikeActionStatus', 3 );
				});
		},

		/*
			Unlikes a post
		*/
		unlikePost( { commit, state, dispatch }, data ){
			commit( 'setPostUnlikeActionStatus', 1 );

			axios.delete('/like/post/' + data.id)
				.then( function( response ){
					commit( 'setPostLikedStatus', false );
					commit( 'setPostUnlikeActionStatus', 2 );

					/*
						Reloads the post and update the liked status.
					*/
					dispatch( 'loadPost', { id: data.id } );

					commit( 'updatePostLikedStatus', { id: data.id, count: 0 });
				})
				.catch( function(){
					commit( 'setPostUnlikeActionStatus', 3 );
				});
		},

		/*
			Clear the liked and unliked status for the posts.
		*/
		clearLikeAndUnlikeStatus( { commit }, data ){
			commit( 'setPostLikeActionStatus', 0 );
			commit( 'setPostUnlikeActionStatus', 0 );
		},
	}

  /*
    Defines the mutations used
  */
	const mutations = {
    /*
      Sets the posts
    */
    setPosts( state, posts ){
      state.posts = posts;
	},
    /*
      Set the post
    */
    setPost( state, post ){
      state.post = post;
    },

		/*
			Set the post liked status
		*/
		setPostLikedStatus( state, status ){
			state.postLiked = status;
		},

		/*
			Set the post like action status
		*/
		setPostLikeActionStatus( state, status ){
			state.postLikeActionStatus = status;
		},

		/*
			Set the post unlike action status
		*/
		setPostUnlikeActionStatus( state, status ){
			state.postUnlikeActionStatus = status;
		},

		updatePostLikedStatus( state, data ){
			for( var i = 0; i < state.posts.length; i++ ){
				if( state.posts[i].id == data.id ){
					state.posts[i].user_like_count = data.count;
				}
			}
		},
	setPostsLoadStatus( state, status ){
	    state.postsLoadStatus = status;
	},
	setPostLoadStatus( state, status ){
      	state.postLoadStatus = status;
	}
	}

  /*
    Defines the getters used by the module
  */
	const getters = {

    getPosts( state ){
      	return state.posts;
	},
    getPost( state ){
      	return state.post;
    },
		/*
			Gets the post liked status
		*/
		getPostLikedStatus( state ){
			return state.postLiked;
		},

		/*
			Gets the post liked action status
		*/
		getPostLikeActionStatus( state ){
			return state.postLikeActionStatus;
		},

		/*
			Gets the post un-like action status
		*/
		getPostUnlikeActionStatus( state ){
			return state.postUnlikeActionStatus;
		},
	getPostsLoadStatus( state ){
      	return state.postsLoadStatus;
	},
	getPostLoadStatus( state ){
      	return state.postLoadStatus;
	}
	}
export default {
  state,
  getters,
  actions,
  mutations
}