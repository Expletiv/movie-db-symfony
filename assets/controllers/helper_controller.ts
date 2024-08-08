import {Controller} from "@hotwired/stimulus";
import {TurboFrameMissingEvent} from "@hotwired/turbo";

export default class extends Controller {

  connect() {
    document.addEventListener('turbo:frame-missing', this.onFrameMissing);
  }

  disconnect() {
    document.removeEventListener('turbo:frame-missing', this.onFrameMissing)
  }

  linkToUrl(event: { params: { url: string; }; }) {
    Turbo.visit(event.params.url);
  }

  preventClick(event: Event) {
    event.stopImmediatePropagation();
  }

  onFrameMissing(event: TurboFrameMissingEvent) {
    const response: Response = event.detail.response;
    if (response.redirected) {
      event.detail.visit(response.url, {action: "advance", frame: undefined});
      event.preventDefault();
    }
  }

}
