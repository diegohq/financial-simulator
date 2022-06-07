import React from "react";

export default class Simulation extends React.Component {

    constructor(props) {
        super(props);

        // this.state = {
        //     simulation: props.simulation
        // }
    }

    render() {
        return (
            <div className="card-body">

                <div className="form-group row">
                    <label className="col-sm-4 col-form-label">Valor
                        bruto</label>
                    <div className="col-sm-8">
                        {this.props.simulation.gross_amount}
                    </div>
                </div>

                <div className="form-group row">
                    <label className="col-sm-4 col-form-label">Descontos</label>
                    <div className="col-sm-8">
                        {this.props.simulation.discounts}
                    </div>
                </div>

                <div className="form-group row">
                    <label className="col-sm-4 col-form-label">Valor líquido</label>
                    <div className="col-sm-8">
                        {this.props.simulation.final_amount}
                    </div>
                </div>
            </div>
        );
    }

}
