import React, { Component, PropTypes } from 'react';
import { connect } from 'react-redux';
import { Link } from 'react-router';

export class Home extends Component {

	render() {
		return(
			<div className="row">
				<div className="columns">
					<p>For a taste of what's coming, check out:</p>
					<ul>{this.props.commands.map( ( command ) => {
						return (
							<li key={command.id}>
								<Link to={command.link}>{command.title}</Link> - {command.description}
							</li>
						);
					})}
					</ul>
				</div>
			</div>
		);
	}

}

Home.propTypes = {
	commands: PropTypes.array,
}

Home.defaultProps = {
	commands: [],
}

export function mapStateToProps( state, ownProps ) {
	if ( state.commands.isLoading ) {
		return ownProps;
	}

	let commands = state.commands.items;
	return {
		...ownProps,
		commands,
	}
}

export default connect( mapStateToProps )( Home );
