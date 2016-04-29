import { combineReducers } from 'redux';
import {
	COMMANDS_LIST_REQUEST,
	COMMANDS_LIST_REQUEST_SUCCESS,
	COMMANDS_LIST_REQUEST_FAILURE,
} from './actions/commands';

export function commands( state = {
	isLoading: false,
	items: []
}, action ) {

	switch( action.type ) {
		case COMMANDS_LIST_REQUEST:
			state = { ...state, isLoading: true };
			break;
		case COMMANDS_LIST_REQUEST_SUCCESS:
			state = { ...state, isLoading: false, items: action.items };
			break;
		case COMMANDS_LIST_REQUEST_FAILURE:
			state = { ...state, isLoading: false };
			break;
	}

	return state;
};

export default combineReducers({
	commands
});
