import React from 'react';
import ReactDOM from 'react-dom';
import CurrencyInput from 'react-currency-input-field';
import axios from "axios";
import Simulation from "./Simulation";

export default class Simulator extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            application: 'cdb',
            initialAmount: 0,
            time: 0,
            timeType: 'years',
            annualInterest: 100,
            baseTax: 'cdi',
            simulation: null,
            formatedData: null,
            submitDisabled: false,
            submitText: "Simular",
            error: null
        }

        this.days = this.days.bind(this);
        this.handleApplication = this.handleApplication.bind(this);
        this.handleTimeType = this.handleTimeType.bind(this);
        this.handleBaseTax = this.handleBaseTax.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
        this.reset = this.reset.bind(this);

        this.reset();
    }

    handleApplication(event) {
        this.setState({application: event.target.value});
    }

    handleTimeType(event) {
        this.setState({timeType: event.target.value});
    }

    handleBaseTax(event) {
        this.setState({baseTax: event.target.value});
    }

    days() {
        if(this.state.timeType === 'days') {
            return this.state.time;
        }

        if(this.state.timeType === 'months') {
            return this.state.time * 30;
        }

        return this.state.time * 360;
    }

    handleSubmit(event) {
        event.preventDefault();

        if(this.state.initialAmount == undefined || this.state.initialAmount <= 0 || typeof this.state.initialAmount == 'numeric') {
            this.setState({
                error: "Valor inicial é obrigatório e deve ser um número maior que zero"
            });
            return;
        }

        if(this.state.time == undefined || this.state.time == 0 || typeof this.state.time == 'numeric') {
            this.setState({
                error: "Prazo é obrigatório e deve ser um número maior que zero"
            });
            return;
        }

        if(this.state.annualInterest == undefined || this.state.annualInterest == 0 || typeof this.state.annualInterest == 'numeric') {
            this.setState({
                error: "Taxa é obrigatória e deve ser um número maior que zero"
            });
            return;
        }

        this.setState({
            error: null,
            submitDisabled: true,
            submitText: "Simulando"
        });

        // No need to call setState here...
        this.state.formatedData = {
            'initial_amount': this.state.initialAmount,
            'days': this.days(),
            'annual_interest': this.state.annualInterest / 100,
            'base_tax': this.state.baseTax
        };

        axios.post(
            `/api/simulators/${this.state.application}`,
            this.state.formatedData
        ).then((response) => {
            this.setState({
                simulation: response.data,
            });
        })

    }

    reset() {
        this.setState({
            // application: 'cdb',
            // initialAmount: 0,
            // time: 0,
            // timeType: 'years',
            // annualInterest: 100,
            // baseTax: 'cdi',
            simulation: null,
            formatedData: null,
            submitDisabled: false,
            submitText: "Simular",
            error: null
        });
    }

    render() {
        return this.state.simulation !== null && this.state.formatedData !== null ?
            ( <div>
                <Simulation simulation={this.state.simulation} data={this.state.formatedData} />
                <div className="row mt-3">
                    <button onClick={this.reset} className="btn btn-primary btn-block">Fazer nova simulação</button>
                </div>
            </div> )
            : (
            <form onSubmit={this.handleSubmit}>

                <div className="form-group row">
                    <label htmlFor="time"
                           className="col-sm-3 col-form-label">Aplicação*</label>
                    <div className="col-sm-9">
                        <select value={this.state.application} onChange={this.handleApplication} className="form-select">
                            <option value="raw">Nenhuma (juros compostos)</option>
                            <option value="cdb">CDB</option>
                            <option value="lc">LC</option>
                            <option value="lca">LCA</option>
                            <option value="lci">LCI</option>
                        </select>
                    </div>
                </div>

                <div className="form-group row mt-2">
                    <label htmlFor="initial_amount"
                           className="col-sm-3 col-form-label">Valor
                        inicial*</label>
                    <div className="col-sm-9">
                        <CurrencyInput
                            className="form-control"
                            id="initialAmount"
                            name="initialAmount"
                            prefix={"R$ "}
                            decimalsLimit={2}
                            allowNegativeValue={false}
                            onValueChange={(value) => this.state.initialAmount = value}
                        />
                    </div>
                </div>
                <div className="form-group row mt-2">
                    <label htmlFor="time"
                           className="col-sm-3 col-form-label">Prazo*</label>
                    <div className="col-sm-6">
                        <CurrencyInput
                            className="form-control"
                            id="time"
                            name="time"
                            allowDecimals={false}
                            allowNegativeValue={false}
                            onValueChange={(value) => this.state.time = value}
                        />
                    </div>
                    <div className="col-sm-3">
                        <select value={this.state.timeType} onChange={this.handleTimeType} className="form-select">
                            <option value="days">Dias</option>
                            <option value="months">Meses</option>
                            <option value="years">Anos</option>
                        </select>
                    </div>
                </div>
                <div className="form-group row mt-2">
                    <label htmlFor="tax"
                           className="col-sm-3 col-form-label">Taxa*</label>
                    <div className="col-sm-6">
                        <CurrencyInput
                            className="form-control"
                            id="annualInterest"
                            name="annualInterest"
                            suffix={"%"}
                            allowDecimals={false}
                            allowNegativeValue={false}
                            defaultValue={100}
                            onValueChange={(value) => this.state.annualInterest = value}
                        />
                    </div>
                    <div className="col-sm-3">
                        <select value={this.state.baseTax} onChange={this.handleBaseTax} className="form-select">
                            <option value="selic">SELIC</option>
                            <option value="cdi">CDI</option>
                            <option value="raw">Pré-fixado</option>
                        </select>
                    </div>
                </div>

                <div className="row text-danger mt-3 mb-2" role="alert">
                    {this.state.error}
                </div>

                <div className="form-group row mt-2">
                    <button type="submit" disabled={this.state.submitDisabled} className="btn btn-primary">
                        {this.state.submitText}
                    </button>
                </div>

            </form>
        )
    }
}

if (document.getElementById('simulator')) {
    ReactDOM.render(<Simulator />, document.getElementById('simulator'));
}
