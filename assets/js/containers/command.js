import React, { Component, PropTypes } from 'react';
import { connect } from 'react-redux';
import { Link } from 'react-router';
import _ from 'underscore';
import NotFound from '../components/not-found';

export class Command extends Component {

	render() {
		let command = this.props.command;

		if ( _.isEmpty( command ) ) {
			return (
				<NotFound text='Command Not Found' />
			);
		}

		let description = '';
		if ( ! _.isEmpty( command.description ) ) {
			description = (
				<p className="page-description">{command.description}</p>
			);
		}

		return (
			<header className="page-header">
				<h2>{command.title}</h2>
				{description}
			</header>
		);
	}

}

export function mapStateToProps( state, ownProps ) {
	if ( state.commands.isLoading ) {
		return {
			...ownProps,
			isLoading: true,
		};
	}

	let command = _.find( state.commands.items, { slug: ownProps.params.slug } );

	return {
		...ownProps,
		isLoading: false,
		command,
	};
};

export default connect( mapStateToProps )( Command );
