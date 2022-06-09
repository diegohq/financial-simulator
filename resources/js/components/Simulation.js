import React from "react";

export default class Simulation extends React.Component {

    formatPrice(value) {
        let val = (value/1).toFixed(2).replace('.', ',')
        return 'R$ ' + val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
    }

    render() {
        return (

            <div>
                <ul className="list-group">
                    <li className="list-group-item">
                        <strong>Valor inicial: </strong>
                        {this.formatPrice(this.props.data.initial_amount)}
                    </li>
                    <li className="list-group-item">
                        <strong>Valor bruto: </strong>
                        {this.formatPrice(this.props.simulation.gross_amount)}
                    </li>
                    <li className="list-group-item">
                        <strong>Descontos: </strong>
                        {this.formatPrice(this.props.simulation.discounts)}
                    </li>
                    <li className="list-group-item list-group-item-action active">
                        <strong>Valor líquido: </strong>
                        {this.formatPrice(this.props.simulation.final_amount)}
                    </li>
                </ul>

                <small>
                    Este serviço é apenas uma simulação, ao aplicar o valor algumas diferenças poderão acontecer. Não nos responsabilizamos por eventuais erros ou más decisões tomadas a partir dessa ferramenta.
                </small>

            </div>
        );
    }

}
