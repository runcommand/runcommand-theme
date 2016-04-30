import Request from 'superagent';
import _ from 'underscore';

const BASE_URL = '/api/v1';
const COMMANDS_BASE_URL = BASE_URL + '/commands';

export const COMMAND_LIST_REQUEST = 'COMMAND_LIST_REQUEST';
export const COMMAND_LIST_REQUEST_SUCCESS = 'COMMAND_LIST_REQUEST_SUCCESS';
export const COMMAND_LIST_REQUEST_FAILURE = 'COMMAND_LIST_REQUEST_FAILURE';

export function listGroups( dispatch ) {
	dispatch({
		type: COMMAND_LIST_REQUEST
	});
	let query = {};
	Request.get( COMMANDS_BASE_URL ).query( query ).end(function( err, res ){
		if ( res && 200 === res.statusCode ) {
			let items = res.body;
			dispatch({
				type: COMMAND_LIST_REQUEST_SUCCESS,
				items: items,
			});
		} else {
			dispatch({
				type: COMMAND_LIST_REQUEST_FAILURE,
				message: res.body.message,
			});
		}
	});
}
