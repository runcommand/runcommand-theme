import React from 'react';
import { mount, shallow } from 'enzyme';
import { expect } from 'chai';
import NotFound from '../../assets/js/components/not-found.js';

describe('<NotFound /> (components)',() => {

	it('renders with text', () => {
		let component = shallow(<NotFound />);
		expect( component.text() ).to.equal('Page Not Found');
	})

})
