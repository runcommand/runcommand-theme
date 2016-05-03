import React from 'react';
import { shallow } from 'enzyme';
import { expect } from 'chai';
import Header from '../../assets/js/components/header.js';

describe('<Header /> (components)',() => {

	it('renders with text', () => {
		let component = shallow(<Header />);
		expect( component.find('span.site-description').text() ).to.contain('fastest');
	})

})
