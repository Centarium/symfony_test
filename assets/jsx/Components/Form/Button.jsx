import PropTypes from "prop-types";
import React, {Component} from 'react';
import classNames from 'classnames';

class Button extends Component
{
    render() {
        const cssclasses = classNames('Button', this.props.className);
        return this.props.href
            ? <a {...this.props} className={cssclasses} />
            : <button {...this.props} className={cssclasses} />;
    }
}

Button.propTypes = {
    href : PropTypes.string,
};

export default Button