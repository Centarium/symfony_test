import PropTypes from "prop-types";
import React from 'react';

const Actions = props =>
    <div className="Actions" >
        <span tabIndex="0" className="ActionsInfo" data-operation="info" title="More info" onClick={props.onAction}>
            &#8505;
        </span>
        <span tabIndex="0" className="ActionsEdit" data-operation="edit" title="Edit" onClick={props.onAction}>
            &#10000;
        </span>
        <span tabIndex="0" className="ActionsDelete" data-operation="delete" title="Delete" onClick={props.onAction}>
            x
        </span>
    </div>

Actions.propTypes = {
    onAction: PropTypes.func,
};

Actions.defaultProps = {
    onAction: () => {},
};

export default Actions