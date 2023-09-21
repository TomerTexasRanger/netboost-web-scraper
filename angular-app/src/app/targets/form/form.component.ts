import {Component, EventEmitter, Output} from '@angular/core';
import {AbstractControl, FormBuilder, FormGroup, ValidatorFn, Validators} from "@angular/forms";
import {TargetModel} from "../../shared/models/target.model";

export function NumberValidator(): ValidatorFn {
  return (control: AbstractControl): { [key: string]: any } | null => {
    if (control.value == null || control.value === '') return null;

    const valid = /^\d+$/.test(control.value);
    return valid ? null : {'invalidNumber': {value: control.value}};
  };
}

export interface TargetFormInterface {
  url: string;
  depth: number;
}

@Component({
  selector: 'app-target-form',
  templateUrl: './form.component.html',
  styleUrls: ['./form.component.scss']
})
export class FormComponent {
  form: FormGroup;

  @Output() handleSubmit = new EventEmitter<TargetFormInterface>()
  readonly urlPattern = new RegExp('^(https?:\\/\\/)?' +
    '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|' +
    '((\\d{1,3}\\.){3}\\d{1,3}))' +
    '(\\:\\d+)?' + // port
    '(\\/[-a-z\\d%_.~+@]*)*' +
    '(\\?[;&a-z\\d%_.~+=-]*)?' +
    '(\\#[-a-z\\d_]*)?$', 'i');

  constructor(fb: FormBuilder) {
    this.form = fb.group({
      'url': [null, [Validators.required, Validators.pattern(this.urlPattern)]],
      'depth': [1, []]
    }, {updateOn: 'change'});
  }


  submitUrl() {
    this.form.markAllAsTouched();
    if (this.form.valid) {
      this.handleSubmit.emit(this.form.value)
    }
  }
}
