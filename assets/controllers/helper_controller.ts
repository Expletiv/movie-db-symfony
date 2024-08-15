import {Controller} from "@hotwired/stimulus";
import {FetchResponse, FrameElement, TurboBeforeFetchResponseEvent, TurboFrameMissingEvent} from "@hotwired/turbo";

export default class extends Controller {

  private boundBeforeFetchResponse: any;

  connect() {
    this.boundBeforeFetchResponse = this.beforeFetchResponse.bind(this);
    document.addEventListener('turbo:before-fetch-response', this.boundBeforeFetchResponse);
  }

  disconnect() {
    document.removeEventListener('turbo:before-fetch-response', this.boundBeforeFetchResponse)
  }

  linkToUrl(event: { params: { url: string; }; }) {
    Turbo.visit(event.params.url);
  }

  stopEvent(event: Event) {
    event.stopImmediatePropagation();
  }

  beforeFetchResponse(event: TurboBeforeFetchResponseEvent) {
    const response: FetchResponse = event.detail.fetchResponse;
    const location = response.header('turbo-location');
    if (location) {
      Turbo.visit(location, {action: 'advance'});
      event.preventDefault();
    }
  }

}
