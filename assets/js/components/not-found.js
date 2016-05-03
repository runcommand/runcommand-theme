import React, { Component, PropTypes } from 'react';

class NotFound extends Component {

	render() {
		return (
			<h2>{this.props.text}</h2>
		);
	}

}

NotFound.propTypes = {
	text: PropTypes.string,
};

NotFound.defaultProps = {
	text: 'Page Not Found',
};

export default NotFound;
