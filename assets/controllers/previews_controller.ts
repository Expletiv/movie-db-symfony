import {Controller} from "@hotwired/stimulus";

export default class extends Controller {

  static targets = ['editButton', 'cancelButton', 'editComponent'];

  static values = {isEditing: {type: Boolean, default: false}}

  private previews: HTMLElement[] = [];

  private animationClasses: string[] = ['card-preview-animated', 'card-preview-details-hover'];

  declare private editButtonTarget: HTMLButtonElement;
  declare private cancelButtonTarget: HTMLButtonElement;
  declare private editComponentTargets: HTMLElement[];

  declare private isEditingValue: boolean;

  connect() {
    this.previews = Array.from(document.querySelectorAll('.card'));
    this.isEditingValueChanged(this.isEditingValue);
  }

  edit() {
    this.isEditingValue = true;
  }

  cancelEdit() {
    this.isEditingValue = false;
  }

  isEditingValueChanged(isEditing: boolean) {
    this.editComponentTargets.forEach(component => component.hidden = !isEditing);
    isEditing ? this.deactivateAnimations() : this.activateAnimations();
    this.editButtonTarget.hidden = isEditing;
    this.cancelButtonTarget.hidden = !isEditing;
  }

  deactivateAnimations() {
    this.previews.forEach(preview => preview.classList.remove(...this.animationClasses));
  }

  activateAnimations() {
    this.previews.forEach(element => element.classList.add(...this.animationClasses));
  }
}
